
<?= \zainiafzan\widget\Dropzone::widget([
    'options' => [
        'addRemoveLinks'    => true,
        'url'               => 'create',
    ],
    'clientEvents' => [
        'complete' => "function(file,dataUrl){
                 document.getElementById('gods-image').setAttribute('value',file.name);
            }",
        'removedfile' => "function(file){

                /*var value = document.getElementById('gods-image').value;
                string= file.name
                if(value.indexOf(string)!=-1){
                    newvalue = value.replace(string,'');
    
                }else if(value.indexOf(file.name)!=-1){
                    newvalue = value.replace(file.name,'');
                }else{
                    newvalue = value
                }                 
                document.getElementById('gods-image').setAttribute('value',newvalue);*/
            }",
        'success'=>'function(file){console.log(file)}',
        'sending' => "function(file, xhr, formData){formData.append('".Yii::$app->request->csrfParam."','".Yii::$app->request->getCsrfToken() ."')}"
    ]
])?>