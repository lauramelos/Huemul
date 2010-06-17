<?php use_helper('I18N') ?>
<form action="<?php echo url_for('sfGuardAuth/signin') ?>" method="post">
  <table class="orange">
    <caption><?php echo __('Login'); ?></caption>
    <?php echo $form ?>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="Aceptar" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
<hr />
<h4>A9CAD</h4>
<p>Si usted necesita un editor CAD gratuito para diseño y edición 2D, con las herramientas básicas y necesarias que pueda leer archivos .dwg puede utitlizar <a href="http://www.a9tech.com/" target="_blank" title="A9CAD">A9CAD</a>.</p>
<hr />
