<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Domain $domain
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading">
                <?= __('Actions') ?>
            </h4>
            <?= $this->Html->link(__('Lista de dominios'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="domains form content">
            <?= $this->Form->create($domain, ['type' => 'file']) ?>
            <fieldset>
                <legend>
                    <?= __('Agregar dominio') ?>
                </legend>
                <?php
                echo $this->Form->hidden('_csrfToken', ['value' => $this->request->getAttribute('csrfToken')]);
                echo $this->Form->control('dominio', ['type' => 'text']);
                echo $this->Form->control('checked', ['type' => 'select', 'options' => ['1' => 'Si', '0' => 'No']]);

                echo $this->Form->control('tiene favicon', ['type' => 'select', 'options' => ['1' => 'Sí', '0' => 'No']]);
                echo $this->Form->control('ruta favicon', ['type' => 'file']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>