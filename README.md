# yii2-wordperss-menu
Это расширение позволить создавать  меню по типу wordpress. Тоесть в админке вы устанвливаете меню как с уровнеями вложености 
так и добавляете заранее созданые меню. 
Подключается
```php
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
```
---
**imageDownloadPath**, **imageSetPath** - указание путей при загрузке картинок (если к меню планируется подключить картинки)
**imageResize** - массив с желаемыми размерами картинок
**extra_menu** - дополнительные меню можно использовать для создания
**models** - масссив выборок для добавления пунктов меню
**models** - модель которую хотие добавить к выборке
**label** - название выпадающего списка в админке
**title** - из какого столбца брать пункты меню
**id** - из какого столбца брать id
**alias** - если вы указали алиасы в базе данных укажите столбец
**path** - путь для роутинга на frontend
**image** - если вы хотите добавлять картинки

миграция php yii migrate/ --migrationPath=@vendor/sirgalas/yii2-wordperss-menu/migrations
