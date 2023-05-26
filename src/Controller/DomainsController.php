<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;
use Cake\I18n\Time;

/**
 * Domains Controller
 *
 * @property \App\Model\Table\DomainsTable $Domains
 * @method \App\Model\Entity\Domain[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DomainsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // limita cantidad registro que muestra por pagina
        $domains = $this->paginate($this->Domains, ['limit' => 5]);

        $this->set(compact('domains'));
    }

    /**
     * View method
     *
     * @param string|null $id Domain id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $domain = $this->Domains->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('domain'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $domain = $this->Domains->newEmptyEntity();
        if ($this->request->is('post')) {

            $domain = $this->Domains->patchEntity($domain, $this->request->getData());

            // agregar imagemn del libro
            $imagen = $this->request->getData('ruta_favicon');
            $dominio = $this->request->getData('dominio');

            // print_r($this->request->getData());
            //  exit();

            if ($imagen !== "") {

                $tiempo = FrozenTime::now()->toUnixString();
                $nombreimagen = $tiempo . "_" . $imagen->getClientFileName();
                $destino = WWW_ROOT . 'img/favicon/' . $nombreimagen;
                $imagen->moveTo($destino);
                $domain->path_favicon = $nombreimagen;







            }

            //toma el tiempo de creacion
            $fechaHoraActual = Time::now();
            $domain->created = $fechaHoraActual;
            // asigna nombre a dominio

            $domain->domain = $dominio;




            // guardar bd
            if ($this->Domains->save($domain)) {
                $this->Flash->success(__('The domain has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The domain could not be saved. Please, try again.'));
        }
        $this->set(compact('domain'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Domain id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $domain = $this->Domains->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            //recuperamo imagen anterior en caso de no llenar una en file
            $nombreimagenanterior = $domain->path_favicon;

            $domain = $this->Domains->patchEntity($domain, $this->request->getData());

            //si selecciono imagen validar y cargar info
            $imagen = $this->request->getData('path_favicon');

            //recupera la imagen anterior
            $domain->path_favicon = $nombreimagenanterior;

            //valida si la imagen fue selecionada
            if ($imagen->getClientFilename()) {

                // borra la image anterior
                if (file_exists(WWW_ROOT . 'img/favicon/' . $nombreimagenanterior)) {
                    unlink(WWW_ROOT . 'img/favicon/' . $nombreimagenanterior);

                }

                $tiempo = FrozenTime::now()->toUnixString();
                $nombreimagen = $tiempo . "_" . $imagen->getClientFileName();
                $destino = WWW_ROOT . 'img/favicon/' . $nombreimagen;
                $imagen->moveTo($destino);
                $domain->path_favicon = $nombreimagen;




            }

            //toma el tiempo que fue editado
            $fechaHoraActual = Time::now();
            $domain->modified = $fechaHoraActual;





            if ($this->Domains->save($domain)) {
                $this->Flash->success(__('The domain has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The domain could not be saved. Please, try again.'));
        }
        $this->set(compact('domain'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Domain id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $domain = $this->Domains->get($id);

        if (file_exists(WWW_ROOT . 'img/favicon/' . $domain['path_favicon'])) {
            unlink(WWW_ROOT . 'img/favicon/' . $domain['path_favicon']);

        }




        if ($this->Domains->delete($domain)) {
            $this->Flash->success(__('The domain has been deleted.'));
        } else {
            $this->Flash->error(__('The domain could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}