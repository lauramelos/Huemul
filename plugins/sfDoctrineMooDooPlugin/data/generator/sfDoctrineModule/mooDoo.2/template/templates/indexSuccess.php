[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets.list') ?]

<div id="sf_admin_container" class="admin_list">

  <h1>[?php echo <?php echo $this->getI18NString('list.title') ?> ?]</h1>

  [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

  <div id="sf_admin_header">
    [?php include_partial('<?php echo $this->getModuleName() ?>/list_header', array('pager' => $pager)) ?]
  </div>

<?php if ($this->configuration->hasFilterForm()): ?>
  <div id="sf_admin_bar">
    <ul class="menu">
      <li class="filters"><a class="opt_filter">[?php echo __('Filter'); ?]</a></li>
      <li><a>[?php echo __('Pendientes'); ?]</a></li>
      <li><a>[?php echo __('Nuevos'); ?]</a></li>
      <li><a>[?php echo __('Para Autorizar'); ?]</a></li>
      <li><a>[?php echo __('Autorizados'); ?]</a></li>
      <li>[?php echo link_to(__('Sacar filtros', array(), 'sf_admin'), '<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?]</li>
    </ul>

    [?php include_partial('<?php echo $this->getModuleName() ?>/filters', array('form' => $filters, 'configuration' => $configuration)) ?]
  </div>
<?php endif; ?>

  <div id="sf_admin_content">
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
    <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'batch')) ?]" method="post">
<?php endif; ?>
    [?php include_partial('<?php echo $this->getModuleName() ?>/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?]
    <ul class="sf_admin_actions">
      [?php include_partial('<?php echo $this->getModuleName() ?>/list_batch_actions', array('helper' => $helper)) ?]
      [?php include_partial('<?php echo $this->getModuleName() ?>/list_actions', array('helper' => $helper)) ?]
    </ul>
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
    </form>
<?php endif; ?>
  </div>

  <div id="sf_admin_footer">
    [?php include_partial('<?php echo $this->getModuleName() ?>/list_footer', array('pager' => $pager)) ?]
  </div>
</div>
