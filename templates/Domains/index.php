<?php
use Cake\Routing\Router;

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Domain> $domains
 */
?>
<div class="domains index content">
    <?= $this->Html->link(__('Nuevo dominio'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3>
        <?= __('Dominios') ?>
    </h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>
                        <?= $this->Paginator->sort('id') ?>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('dominio') ?>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('checked') ?>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('tiene favicon') ?>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('Favicon') ?>
                    </th>
                    <th class="actions">
                        <?= __('Actions') ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($domains as $domain): ?>
                    <tr>
                        <td>
                            <?= $this->Number->format($domain->id) ?>
                        </td>
                        <td>
                            <?php
                            // saca solo el dominio y se dirreciona a el 
                            $parsedUrl = parse_url($domain->domain);
                            $domainName = isset($parsedUrl['host']) ? $parsedUrl['host'] : $domain->domain;
                            $href = 'http://' . $domainName;
                            ?>
                            <a href="<?= h($href) ?>" target="_blank"><?= h($href) ?></a>

                        </td>
                        <td>
                            <?php if ($domain->checked == 1) {
                                $repuesta = 'Si'; ?>
                                <?= h($repuesta) ?>
                            <?php } else {
                                $repuesta = 'No'; ?>
                                <?= h($repuesta) ?>
                            <?php } ?>
                        </td>

                        <td>
                            <?php if ($domain->has_favicon == 1) {
                                $repuesta = 'Si'; ?>
                                <?= h($repuesta) ?>
                            <?php } else {
                                $repuesta = 'No'; ?>
                                <?= h($repuesta) ?>
                            <?php } ?>

                        </td>
                        <td>
                            <?= $this->Html->image('favicon/' . $domain->path_favicon, array('width' => 40)); ?>
                        </td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $domain->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $domain->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $domain->id], ['confirm' => __('Are you sure you want to delete # {0}?', $domain->id)]) ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p>
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </p>
    </div>
</div>