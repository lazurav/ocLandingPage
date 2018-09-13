<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-landing" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-landing" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-url_param"><span data-toggle="tooltip" title="<?php echo $text_help_url_param; ?>"><?php echo $entry_url_param; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="landing[url_param]" value="<?php echo isset($landing['url_param']) ? $landing['url_param'] : '/'; ?>" placeholder="<?php echo $entry_url_param; ?>" id="input-url_param" class="form-control" />
              <?php if ($error_url_param) { ?>
              <div class="text-danger"><?php echo $error_url_param; ?></div>
              <?php } ?>
            </div>
          </div>
           <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-name" ><?php echo $entry_name; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="landing[name]" value="<?php echo isset($landing['name']) ? $landing['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
                  <?php if ($error_name) { ?>
                  <div class="text-danger"><?php echo $error_name; ?></div>
                  <?php } ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="landing[status]" id="input-status" class="form-control">
                    <?php if ($landing['status'] == '1') { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
            </div>
          <ul class="nav nav-tabs" id="language">
            <?php foreach ($languages as $language) { ?>
            <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
            <?php } ?>
          </ul>
          <div class="tab-content">
          <?php foreach ($languages as $language) { ?>
            <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" title="<?php echo $text_help_title; ?>"><?php echo $entry_meta_title; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="landing_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($landing_description[$language['language_id']]) ? $landing_description[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                  <?php if (isset($error_meta_title[$language['language_id']])) { ?>      
                    <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                <div class="col-sm-10">
                  <textarea name="landing_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" data-lang="<?php echo $lang; ?>" class="form-control summernote"><?php echo isset($landing_description[$language['language_id']]) ? $landing_description[$language['language_id']]['description'] : ''; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-meta-h1<?php echo $language['language_id']; ?>"><?php echo $entry_meta_h1; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="landing_description[<?php echo $language['language_id']; ?>][meta_h1]" value="<?php echo isset($landing_description[$language['language_id']]) ? $landing_description[$language['language_id']]['meta_h1'] : ''; ?>" placeholder="<?php echo $entry_meta_h1; ?>" id="input-meta-h1<?php echo $language['language_id']; ?>" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
                <div class="col-sm-10">
                  <textarea name="landing_description[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($landing_description[$language['language_id']]) ? $landing_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
                <div class="col-sm-10">
                  <textarea name="landing_description[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($landing_description[$language['language_id']]) ? $landing_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                </div>
              </div>
            </div>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
    <?php if ($ckeditor) { ?>
    <?php foreach ($languages as $language) { ?>
      ckeditorInit('input-description<?php echo $language['language_id']; ?>', getURLVar('token'));
      <?php } ?>
    <?php } ?>
  //--></script>
  <script type="text/javascript"><!--
    $('#language a:first').tab('show');
    //--></script></div>
</div>
<?php echo $footer; ?>
