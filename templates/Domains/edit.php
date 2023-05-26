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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $domain->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $domain->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Lista de dominios'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="domains form content">
            <?= $this->Form->create($domain, ['type' => 'file']) ?>
            <fieldset>
                <legend>
                    <?= __('Editar dominio') ?>
                </legend>
                <?php

                echo $this->Form->control('domain', ['type' => 'text']);

                echo $this->Form->control('checked', ['type' => 'select', 'options' => ['1' => 'Si', '0' => 'No']]);
                echo $this->Form->control('has_favicon', ['type' => 'select', 'options' => ['1' => 'Sí', '0' => 'No']]);

                echo $this->Html->image('favicon/' . $domain->path_favicon, array('width' => 100)) ;

                echo $this->Form->control('path_favicon', ['type' => 'file', 'required'=>false]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Guardar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>