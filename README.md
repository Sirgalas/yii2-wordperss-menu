# yii2-wordperss-menu
Это расширение позволить создавать  меню по типу wordpress. Тоесть в админке вы устанвливаете меню как с уровнеями вложености 
так и добавляете заранее созданые меню. 
Подключается       
backend/config/main.php 
'menu'  =>[
            'class' =>  'sirgalas\menu\MenuModule',
            'imageDownloadPath'     =>  Yii::getAlias('@frontend/').'web/image/menu/',
            'imageSetPath'     =>  Yii::getAlias('@frontendWebroot').'/image/menu/',
            'imageResize'   =>  [[80, 40],[179,156]],
            'extra_menu'    =>  2,
            'models' =>  [
                'class' =>  '\common\models\Category',
                'title' =>  'name',
                'label' =>  'выбирите категорию',
                'id'    =>  'id',
                'alias' =>  'slug_category',
                'path'  =>  '/category',
                'image' =>  'true'
            ],
],            
imageDownloadPath, imageSetPath - указание путей при загрузке картинок (если к меню планируется подключить картинки) 
'imageResize - массив с желаемыми размерами картинок
'extra_menu' = дополнительные меню можно использовать для создания 

миграция php yii migrate/ --migrationPath=@vendor/sirgalas/yii2-wordperss-menu/migrations
