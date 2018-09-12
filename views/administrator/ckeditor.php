<?php echo Yii::t('app','This is the template of the email that will be sent to the applicant when his/her resume change to state ').Yii::t('app',$this->spanState($model->state)); ?>
<?php $this->widget('ckeditor.TheCKEditorWidget',array(
        'id'=>'RTE',
        'model'=>$model,                # Data-Model (form model)
        'attribute'=>'templateEmail',         # Attribute in the Data-Model
        'height'=>'250px',
        'width'=>'95%',
        // 'toolbarSet'=>'Full',          # EXISTING(!) Toolbar (see: ckeditor.js)
        'toolbarSet' => array(
            array(
                'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat',
            ),
            array(
                'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-'
            ),
            array(
                'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'
            ),
            array(
                'Format','Font','FontSize'
            ),
            array(
                'Image','Table','HorizontalRule','SpecialChar'
            ),
            array(
                'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt'
            ),
            array(
                'Link','Unlink','Anchor'
            ),

        ),
        'ckeditor'=>Yii::app()->basePath.'/../js/ckeditor/ckeditor.php',
                                        # Path to ckeditor.php
        'ckBasePath'=>Yii::app()->baseUrl.'/js/ckeditor/',
                                        # Relative Path to the Editor (from Web-Root)
        // 'css' => Yii::app()->baseUrl.'/css/index.css',
                                        # Additional Parameters
    )); ?>