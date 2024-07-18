<?php
include_once "ApiController.php";

// CREATE DATABASE php_spd_111;
// CREATE USER 'spd_111_user'@'localhost' IDENTIFIED BY 'spd_pass';

// GRANT ALL PRIVILEGES ON php_spd_111.* TO 'spd_111_user'@'localhost'
//U3bdwJyuKAeIlb
// FLUSH PRIVILEGES

class TablesController extends ApiController
{

    protected function do_post()
    {
        // $sqlTables = "CREATE TABLE IF NOT EXISTS UserRoles (
        //     `id`    CHAR(36) PRIMARY KEY DEFAULT ( UUID() ),
        //     `roleName`      VARCHAR(64)   NOT NULL,
        //     `userId` CHAR(36) NOT NULL,
        //     FOREIGN KEY (userId) REFERENCES Users(id)
        //     ) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4;


        // CREATE TABLE  IF NOT EXISTS  Users (
		// 	`id`        CHAR(36)      PRIMARY KEY  DEFAULT ( UUID() ),
        //     `user_name`      VARCHAR(64)   NOT NULL,
        //     `surname`   VARCHAR(64)   NOT NULL,
		// 	`email`     VARCHAR(128)  NOT NULL,
        //     `phone`     VARCHAR(64)   NOT NULL,
        //     `address`   VARCHAR(255)  NOT NULL,
		// 	`password`  CHAR(32)      NOT NULL     COMMENT 'Hash of password',
    	// 		`avatar`    VARCHAR(128)  NULL,
       
		// ) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4;

                         

        //     CREATE TABLE IF NOT EXISTS MainGroups (
        //     `id`         CHAR(36)      PRIMARY KEY  DEFAULT ( UUID() ),
        //     `mainGroupName`       VARCHAR(64)   NOT NULL,
        //     `uri_name`   VARCHAR(64)   NOT NULL,
        //     `logo`       CHAR(36)      NOT NULL
        //     ) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4;

        //     CREATE TABLE IF NOT EXISTS SubGroups (
        //     `id`           CHAR(36)   PRIMARY KEY  DEFAULT ( UUID() ),
        //     `subName`         VARCHAR(64)   NOT NULL,
        //     `uri_name`     VARCHAR(64)   NOT NULL,
        //     `img`          CHAR(36) NOT NULL,
        //     `mainGroupId`      CHAR(36) NOT NULL,
        //     FOREIGN KEY (mainGroupId) REFERENCES MainGroups(id)
        //     ) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4; 

        //     CREATE TABLE IF NOT EXISTS ItemGroups (
        //     `id`          CHAR(36)   PRIMARY KEY  DEFAULT ( UUID() ),
        //     `itemGroupName`        VARCHAR(64)   NOT NULL,
        //  //   `uri_name`     VARCHAR(64)   NOT NULL, 
        //     `img`         CHAR(36) DEFAULT ('no_photo.jpg'),
        //     `subGroupId`  CHAR(36) NOT NULL,
        //     FOREIGN KEY (subGroupId) REFERENCES SubGroups(id)
        //     ) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4;

           
        //     CREATE TABLE IF NOT EXISTS Items (
        //     `id`                CHAR(36)     PRIMARY KEY  DEFAULT ( UUID() ),
        //     `itemName`          CHAR(255)    NOT NULL,
        //     `description`       TEXT         NOT NULL,
        //     `itemCode`          CHAR(16)     UNIQUE,
        //     `price`             CHAR(12)     NOT NULL,
        //     `salePrice`         CHAR(12)     NOT NULL DEFAULT( '0' ),
        //     `itemGroupId`       CHAR(36)     NOT NULL,
        //     `onActive`          BOOLEAN      NOT NULL DEFAULT ( true ),
        //     FOREIGN KEY (itemGroupId) REFERENCES ItemGroups(id)
        //     ) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4;

        //     CREATE TABLE IF NOT EXISTS Feedbacks (
        //     `id`          CHAR(36)      PRIMARY KEY  DEFAULT ( UUID() ),
        //     `score`       TINYINT       NOT NULL DEFAULT ( 0 ) CHECK (score BETWEEN -1 AND 6),
        //     `comment`        VARCHAR(512)  NOT NULL DEFAULT ( '' ),
        //     `date`        DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
        //     `itemId`      CHAR(36)      NOT NULL,
        //     FOREIGN KEY (itemId) REFERENCES Items(id)
        //     ) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4;

        //     CREATE TABLE IF NOT EXISTS Features (
        //     `id`          CHAR(36)      PRIMARY KEY  DEFAULT ( UUID() ),
        //     `featureName` CHAR(254)     NOT NULL,
        //     `featureText` TEXT          NOT NULL,
        //     `itemId`      CHAR(36)      NOT NULL,
        //     FOREIGN KEY (itemId) REFERENCES Items(id)
        //     ) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4;

        //     CREATE TABLE IF NOT EXISTS ItemImages (
        //     `id`                 CHAR(36)      PRIMARY KEY  DEFAULT ( UUID() ),
        //     `fileName`           CHAR(64)     NOT NULL,
        //     `itemId`             CHAR(36)      NOT NULL,
        //     FOREIGN KEY (itemId) REFERENCES Items(id)
        //     ) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4;


        //     CREATE TABLE IF NOT EXISTS Basket (
        //     `id`                 CHAR(36) PRIMARY KEY  DEFAULT ( UUID() ),
        //     `userId`             CHAR(36) NOT NULL,
        //     `quatity`            INT NOT NULL DEFAULT ( 1 ) CHECK( quatity > 0 ),
        //     `itemId`             CHAR(36) NOT NULL,
        //     FOREIGN KEY (userId) REFERENCES Users(id),
        //     FOREIGN KEY (itemId) REFERENCES Items(id)
        //     ) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4; 

           
            
          
        //     CREATE TABLE IF NOT EXISTS Orders(
        //     `id` CHAR(36) PRIMARY KEY  DEFAULT ( UUID() ),
        //     `order_number`   INT NOT NULL UNIQUE AUTO_INCREMENT,
        //     `userId`         CHAR(36) NOT NULL,
        //     `date`           DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
        //     `buyer_name`     varchar(64)   NOT NULL,
        //     `buyer_surname`  varchar(64)   NOT NULL,
        //     `email`          VARCHAR(128)  NOT NULL,
        //     `phone`          VARCHAR(64)   NOT NULL,
        //     `address`        VARCHAR(255)  NOT NULL,
        //     `comment`        VARCHAR(512)  NOT NULL DEFAULT ( '' ),
        //     `shipment_method` VARCHAR(255) NOT NULL,
        //     `payment_method` VARCHAR(255)  NOT NULL
        //     FOREIGN KEY (userId) REFERENCES Users(id)
        //     ) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4; 

        //     CREATE TABLE IF NOT EXISTS ItemStatus(
        //     `id`            CHAR(36) PRIMARY KEY NOT NULL,
        //     `status`       CHAR(255) NOT NULL
        //     ) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4;

        //     CREATE TABLE IF NOT EXISTS OrderItems(
        //     `id` CHAR(36) PRIMARY KEY  DEFAULT ( UUID() ),
        //     `itemId`          CHAR(36)      NOT NULL,
        //     `quantity`        INT           NOT NULL,
        //     `statusId`        CHAR(36)      NOT NULL,
        //     `order_number_id` INT           NOT NULL,
        //     `trackNumber`     CHAR(36)      NOT NULL  DEFAULT( '' ),
        //     `price`           CHAR(12)     NOT NULL,
        //     `salePrice`       CHAR(12)     NOT NULL DEFAULT( '0' ),
        //     FOREIGN KEY (statusId) REFERENCES ItemStatus(id),
        //     FOREIGN KEY (itemId) REFERENCES Items(id),
        //     FOREIGN KEY (order_number_id) REFERENCES Orders(order_number)
        //     ) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4;

           

        //  -- INSERT INTO Groups (group_name, logo) VALUES ('Ноутбуки та комп’ютери', 'laptop');
           
        // ";
        //  $this->connect_db_query($sqlTables) ;
         
        // $sqlGroupsAndSubGroups = "
        // INSERT INTO UserRoles (roleName) VALUES ('user') ;
        // INSERT INTO UserRoles (roleName) VALUES ('admin') ;
        // INSERT INTO UserRoles (roleName) VALUES ('operator') ;


        // INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Смартфони, ТВ і Електроніка', 'smartfoni_tv_i_electronika', 'phone_android');
        // INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Товари для геймерів', 'tovari_dlya_geimerov','sports_esports');
        // INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Побутова техніка', 'pobutova_tehnika','local_laundry_service');
        // INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Товари для дому', 'tovari_dlya_domu','chair');
        // INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Інструменти та автотовари', 'instrumenti_ta_avtotovary','construction');
        // INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Сантехніка та ремонт', 'santehnika_ta_remont','bathtub');
        // INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Дача, сад, город', 'dacha_sad_gorod','deck');
        // INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Спорт і захоплення', 'sport_i_zahoplenya','kitesurfing');
        // INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Одяг, взуття та аксесуари', 'odyag_vzutya_ta_aksesuary','checkroom');
        // INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Краса та здоров``я', 'krasa_ta_zdorovya','face');
        // INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Товари для дітей', 'tovari_dlya_ditey','child_friendly');
        // INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Офіс, школа, книги', 'ofis_shkola_knigi','import_contacts');
        // INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Побутова хімія', 'pobutova_himiya','science');

        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Смартфони', 'smartfony', '378644481.jpg','c337ef88-e535-11ee-ae4e-5fd71bfda542');
        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Чохли з принтами', 'chohli_z_printamy', '409690866.webp','c337ef88-e535-11ee-ae4e-5fd71bfda542');
        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Мобільні телефони', 'mobilni_telefony', '378644481.jpg','c337ef88-e535-11ee-ae4e-5fd71bfda542');
        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Чохли для смартфонів', 'chohli_dlya_smartfoniv', '399789347.webp','c337ef88-e535-11ee-ae4e-5fd71bfda542');
        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Смарт-годинники', 'smart_godinniky', '378645138.jpg','c337ef88-e535-11ee-ae4e-5fd71bfda542');
        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Аксесуари', 'acsesuari', 'aksessuary_dlya_mobilnyh.jpg','c337ef88-e535-11ee-ae4e-5fd71bfda542');
        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Фітнес браслети', 'fitnes_braslety', '367323203.webp','c337ef88-e535-11ee-ae4e-5fd71bfda542');
        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Зарядні станції', 'zaryadny_stancii', 'zaryadnye_stancii.png','c337ef88-e535-11ee-ae4e-5fd71bfda542');
        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Power Bank', 'power_bank', '336305793.webp','c337ef88-e535-11ee-ae4e-5fd71bfda542');
        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Навушники', 'navushniky', '352930597.png','c337ef88-e535-11ee-ae4e-5fd71bfda542');
        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Портативна акустика', 'portativna_acustika', 'audiotehnika.jpg','c337ef88-e535-11ee-ae4e-5fd71bfda542');

        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Велика побутова техніка', 'velika_pobutova_tehnika', '325504069.png','c343824e-e535-11ee-ae4e-5fd71bfda542');
        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Вбудовувана побутова техніка', 'vbudovana_pobutova_tehnika', '325504076.png','c343824e-e535-11ee-ae4e-5fd71bfda542');
        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Кліматична техніка', 'klimatichna_tehnika', '372691761.png','c343824e-e535-11ee-ae4e-5fd71bfda542');
        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Догляд за домом і одягом', 'doglyad_za_domom_i_odyagom', '325504074.png','c343824e-e535-11ee-ae4e-5fd71bfda542');
        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Техніка для кухні', 'tehnika_dlya_kuhni', '325504079.png','c343824e-e535-11ee-ae4e-5fd71bfda542');
        // INSERT INTO SubGroups (subName, uri_name, img, mainGroupId) VALUES ('Краса та здоров``я', 'krasa_ta_zdorovya', '325504081.png','c343824e-e535-11ee-ae4e-5fd71bfda542');

        // " ;
        // $this->connect_db_query($sqlGroupsAndSubGroups) ;
       
        // $sortString = "Пральні машини,Сушильні машини,Холодильники,Холодильники Side-by-Side,Бойлери,Витяжки,Посудомийні машини,Морозильні камери,Морозильні скрині,Винні шафи,Плити газові,Плити електричні,Плити комбіновані,Настільні плити,Електродуховки настільні,Льодогенератор,Аксесуари для великої побутової техніки,Холодильні шафи (вітрини)";
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40e090ab-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;
        // $sortString = "Вбудовувана побутова техніка,Вбудовувані посудомийні машини,Вбудовувані холодильники,Вбудовувані духові шафи,Варильні поверхні,Варильні поверхні газові,Вбудовувані мікрохвильові печі,Вбудовувані кавоварки,Вбудовувані пральні машини,Вбудовувані морозильні камери,Вбудовувані винні шафи,Вбудовувані шафи для підігріву посуду";
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40e80ef1-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;
        // $sortString = "Кліматична техніка,Обігрівачі,Зволожувачі повітря,Вентилятори,Витяжні вентилятори,Кондиціонери,Очищувачі повітря,Газові котли,Електричні котли,Твердопаливні котли,Аксесуари до котлів,Водонагрівачі газові,Кліматичні комплекси,Осушувачі повітря,Метеостанції,Термометри-гігрометри";
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40eeec34-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;
        // $sortString = "Пилососи, Роботи-пилососи, Акумуляторні пилососи, Пилососи для сухого прибирання, Пароочисники, Праски, Відпарювачі, Прасувальні системи, Праски з парогенератором, Швейна техніка та аксесуари, Машинки для стриження ковтунців, Сертифікати на продовження гарантії";
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40f47102-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;
        // $sortString = "Світ кави, Мікрохвильові печі, Грилі та електрошашличниці, Мультиварки, Мультипічки і аерогрилі, Кухонні комбайни, Блендери, М'ясорубки, Електрочайники, Настільні плити, Соковижималки (соковичавниці), Кухонні ваги, Побутові вакуумні пакувальники";
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40f8dd3f-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;
        // $sortString = "Зубні щітки, Іригатори та насадки, Фени, Тримери, Прилади для укладання волосся, Машинки для стрижки, Електробритви, Постільна білизна з підігрівом, Епілятори, Фотоепілятори, Ваги підлогові, Прилади для манікюру та педикюру, Масажери";
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40fc9d2a-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;

        // $sortString = "Samsung,Xiaomi,Google,OnePlus,Motorola,Asus,Oukitel,Blackview,Nothing,Honor,ZTE";        
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40ac6400-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;
        // $sortString = "Apple,Samsung,Xiaomi";        
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40b26161-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;
        // $sortString = "Nokia,Sigma-Mobile,Philips,Alcatel,TECNO";        
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40b69510-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;
        // $sortString = "Накладка на задню частину,Чохол-книжка,Сумка-чохол";        
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40bacbe0-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;
        // $sortString = "Захисне скло,Зарядні пристрої,Кабелі,Тримачі та док-станції,Адаптери";        
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40c55e9f-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;
        // $sortString = "Apple,Samsung,Mobvoi,Garmin,Xiaomi,AmazFit,Haylou,Proove";        
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40c1311d-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;
        // $sortString = "Xiaomi,Samsung,Lemfo,Honor";        
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40c9c54e-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;
        // $sortString = "Менше 700 Вт,700-1800 Вт,2000 Вт,Більше 2000 Вт";        
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40cdc72d-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;
        // $sortString = "10000-15999 мАч,20000 мАч та більше,3000-4999 мАч,5000-9999 мАч,16000-19999 мАч,Менше 3000 мАч";        
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40d170b9-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;
        // $sortString = "TWS,Вакуумні,Повнорозмірні,Геймерські,Аксесуари для навушників і гарнітур";        
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40d55e8e-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;
        // $sortString = "JBL,Bose,Marshall,SVEN,Gelius";        
        // $sqlsortString = $this->addSqlSortGroupString($sortString, '40dacd8a-e537-11ee-ae4e-5fd71bfda542');       
        // $this->connect_db_query($sqlsortString) ;

        
    //     $sqlItem = "INSERT INTO Items (itemName, descriptions, price, salePrice, itemGroupId) VALUES 
    //     ('Чохол-книжка Samsung Smart View Wallet Case для Galaxy Лавандовий', 
    //     'Чохол Samsung - це стильний аксесуар, який ідеально підійде для вашого смартфона, оскільки розроблявся спеціально для цієї моделі. Дизайн панелі виконаний з урахуванням особливостей моделі телефону і включає всі необхідні отвори під камеру і роз``єми, отже, вам не доведеться знімати панель, щоб повноцінно використовувати всі функції телефону.',
    //     '1500 ₴', '1399 ₴', 'dd50698f-e581-11ee-b31f-2439b2d1008c')";
    //     $this->connect_db_query($sqlItem) ;

    //     "INSERT INTO ItemImages (`fileName`, itemId) VALUES ('374524975.webp', '4a849794-e618-11ee-b31f-2439b2d1008c')";
    //     "INSERT INTO ItemImages (`fileName`, itemId) VALUES ('409458614.webp', '4a849794-e618-11ee-b31f-2439b2d1008c')";
    //     "INSERT INTO FeedBacks(score, comment, itemId) VALUES ( 4, 'AAAAAAAAA+++++++++', '4a849794-e618-11ee-b31f-2439b2d1008c')";
    //     "INSERT INTO FeedBacks(score, comment, itemId) VALUES ( 3, 'AAAAAAAAA+++++++++OOOOOOOOOOOO', '4a849794-e618-11ee-b31f-2439b2d1008c')";
    //     "INSERT INTO FeedBacks(score, comment, itemId) VALUES ( 5, 'AAAAAAAAA+++++++++OOOOOOOOOOOO++++55555', '4a849794-e618-11ee-b31f-2439b2d1008c')";
    //     "INSERT INTO features(featureName, featureText, itemId) VALUES ('Форм-фактор', 'Чохол-книжка', '4a849794-e618-11ee-b31f-2439b2d1008c')";
    //     "INSERT INTO features(featureName, featureText, itemId) VALUES ('Особливості', 'Захист всього корпусу', '4a849794-e618-11ee-b31f-2439b2d1008c')";
    //     "INSERT INTO features(featureName, featureText, itemId) VALUES ('Колір', 'Lavender', '4a849794-e618-11ee-b31f-2439b2d1008c')";
    //     "INSERT INTO features(featureName, featureText, itemId) VALUES ('Сумісна модель', 'Galaxy S23 Ultra', '4a849794-e618-11ee-b31f-2439b2d1008c')";
    $arrItemApple = ["Панель Apple MagSafe Silicone Case для Apple iPhone 14 Olive",
    "Силиконовый чехол MagSafe от Apple — это стильная защита для iPhone 14.
    Внешняя силиконовая поверхность специально обработана и очень приятна на ощупь. А мягкая подкладка из микрофибры обеспечивает дополнительную защиту iPhone.
    Встроенные магниты точно совпадают с магнитами на задней поверхности iPhone 14 — они надёжно удерживают чехол и, в то же время, позволяют легко его снимать. Магниты идеально совмещают устройства, поэтому беспроводная зарядка выполняется ещё удобнее и быстрее. При этом снимать чехол на время беспроводной зарядки не нужно — достаточно просто присоединить зарядное устройство MagSafe или положить iPhone на зарядное устройство стандарта Qi.
    Как и другие продукты Apple, этот чехол тщательно тестировался несколько тысяч часов — на всех этапах проектирования и производства. В результате он не только прекрасно выглядит, но и отлично защищает iPhone от царапин и повреждений при падении.",

    "900",
    "0",
    '318788099.webp',
    '318788100.webp',
    '318788102.webp',
    "Apple"
    
];
    $arrItemSamsung = [
       "Чохол-книжка Samsung Smart View Wallet Case для Galaxy Лавандовий",
       "Чохол Samsung - це стильний аксесуар, який ідеально підійде для вашого смартфона, оскільки розроблявся спеціально для цієї моделі. Дизайн панелі виконаний з урахуванням особливостей моделі телефону і включає всі необхідні отвори під камеру і роз``єми, отже, вам не доведеться знімати панель, щоб повноцінно використовувати всі функції телефону.",
       "1500",
       "1399",
       '374524975.webp',
        '409458614.webp',
       '415468439.webp',
       'Samsung'
    ];
    
    $this->addSqlItems("dd4bf854-e581-11ee-b31f-2439b2d1008c",  $arrItemApple);
    $this->addSqlItems("dd4d3397-e581-11ee-b31f-2439b2d1008c", $arrItemSamsung);
    }
//dd4bf854-e581-11ee-b31f-2439b2d1008c - apple
//dd4d3397-e581-11ee-b31f-2439b2d1008c - samsung
    protected function addSqlItems($itemGroupId, $arrItem){
        
        $itemName = $arrItem[0];
        $descriptions =  $arrItem[1];
        $price = $arrItem[2];
        $salePrice = $arrItem[3];
        // $itemName_2 = "Панель Apple MagSafe Silicone Case для Apple iPhone 14 Olive";
        // $descriptions_2 =  "Силиконовый чехол MagSafe от Apple — это стильная защита для iPhone 14.
        // Внешняя силиконовая поверхность специально обработана и очень приятна на ощупь. А мягкая подкладка из микрофибры обеспечивает дополнительную защиту iPhone.
        // Встроенные магниты точно совпадают с магнитами на задней поверхности iPhone 14 — они надёжно удерживают чехол и, в то же время, позволяют легко его снимать. Магниты идеально совмещают устройства, поэтому беспроводная зарядка выполняется ещё удобнее и быстрее. При этом снимать чехол на время беспроводной зарядки не нужно — достаточно просто присоединить зарядное устройство MagSafe или положить iPhone на зарядное устройство стандарта Qi.
        // Как и другие продукты Apple, этот чехол тщательно тестировался несколько тысяч часов — на всех этапах проектирования и производства. В результате он не только прекрасно выглядит, но и отлично защищает iPhone от царапин и повреждений при падении.";
        // $price_2 = "900";
        // $salePrice_2 = "0";
        
        $count = 20;
        for($i=0;$i<$count;$i++)
        {
           
            $sqlItem = "INSERT INTO Items (itemName, `description`, price, salePrice, itemGroupId) VALUES
            ('{$itemName}', '{$descriptions}', '{$price}', '{$salePrice}', '{$itemGroupId}')";
            $this->connect_db_query($sqlItem) ;
            
        }
        $sqlItem = "SELECT Id From Items WHERE itemGroupId = '{$itemGroupId}'";
        $res = $this->getDbResult( $sqlItem);
        for($i=0;$i<count($res);$i++)
        { 
            // $photoRes = $i%2;
            // if ($photoRes == 1){
            //     $photo_1 = '374524975.webp';
            //     $photo_2 = '409458614.webp';
            //     $photo_3 = '415468439.webp';
            //     $model = 'Samsung';
            // }
            // else{
            //     $photo_1 = '318788099.webp';
            //     $photo_2 = '318788100.webp';
            //     $photo_3 = '318788102.webp';
            //     $model = "Apple";
            // }

            $idItemStr = $res[$i]["Id"];
           
            $sqlStaf = "INSERT INTO ItemImages (`fileName`, itemId) VALUES ('{$arrItem[4]}', '{$idItemStr}');".
            "INSERT INTO ItemImages (`fileName`, itemId) VALUES ('{$arrItem[5]}', '{$idItemStr}');".
            "INSERT INTO ItemImages (`fileName`, itemId) VALUES ('{$arrItem[6]}', '{$idItemStr}');".
            "INSERT INTO FeedBacks(score, comment, itemId) VALUES ( 4, 'AAAAAAAAA+++++++++', '{$idItemStr}');".
            "INSERT INTO FeedBacks(score, comment, itemId) VALUES ( 3, 'AAAAAAAAA+++++++++OOOOOOOOOOOO', '{$idItemStr}');".
            "INSERT INTO FeedBacks(score, comment, itemId) VALUES ( 5, 'AAAAAAAAA+++++++++OOOOOOOOOOOO++++55555', '{$idItemStr}');".
            "INSERT INTO features(featureName, featureText, itemId) VALUES ('Форм-фактор', 'Чохол-книжка', '{$idItemStr}');".
            "INSERT INTO features(featureName, featureText, itemId) VALUES ('Особливості', 'Захист всього корпусу', '{$idItemStr}');".
            "INSERT INTO features(featureName, featureText, itemId) VALUES ('Колір', 'Lavender', '{$idItemStr}');".
            "INSERT INTO features(featureName, featureText, itemId) VALUES ('Сумісна модель', '{$arrItem[7]}', '{$idItemStr}');";

            $this->connect_db_query($sqlStaf) ;
        }
       
    }

    protected function addSqlSortGroupString($dataString, $subGroupId)
    {

        $dataStringArr = explode(',', $dataString);
        $sql = "";
        foreach ($dataStringArr as $word) {
            $word = trim($word);
            $sql = $sql . "INSERT INTO ItemGroups (itemGroupName, subGroupId) VALUES ('{$word}', '{$subGroupId}');" ;
        }
    echo($sql);
        return $sql;
    }

    private function connect_db_query($sql)
    {
         $db = $this->connect_db_or_exit();
        try {
            $db->query($sql);

        } catch (PDOException $ex) {
            http_response_code(500);
            echo "query error: " . $ex->getMessage();
            exit;
        }
        echo "Hello from do_get - Query OK";
    }

    protected function connect_db_or_exit()
	{
		try {
			return new PDO(
				'mysql:host=localhost;dbname=php_store;charset=utf8mb4',
				'store_user',
				'store_pass',
				[
					PDO::ATTR_PERSISTENT => true,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				]
			);
		} catch (PDOException $e) {
			http_response_code(500);
			echo "Connection error: " . $e->getMessage();
			exit;
		}
	}

    private function getDbResult($sql){
		try {
            $db = $this->connect_db_or_exit();
			$res = $db->query($sql);

			while ($row = $res->fetch()) {
				$arr[] = $row;
			}
			return $arr;
		} catch (PDOException $ex) {
			http_response_code(500);
			echo "query error: " . $ex->getMessage();
			exit;
		}
	}
}


// CREATE TABLE IF NOT EXISTS Descriptions (
//     `id`                 CHAR(36)      PRIMARY KEY  DEFAULT ( UUID() ),
//     `description`        TEXT   NOT NULL
//     ) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4;
// $sqlGroupsAndSubGroups = "
// INSERT INTO UserRoles (roleName) VALUES ('user', 'admin', 'operator') ;

// INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Смартфони, ТВ і Електроніка', 'smartfoni_tv_i_electronika', 'phone_android');
// INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Товари для геймерів', 'tovari_dlya_geimerov','sports_esports');
// INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Побутова техніка', 'pobutova_tehnika','local_laundry_service');
// INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Товари для дому', 'tovari_dlya_domu','chair');
// INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Інструменти та автотовари', 'instrumenti_ta_avtotovary','construction');
// INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Сантехніка та ремонт', 'santehnika_ta_remont','bathtub');
// INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Дача, сад, город', 'dacha_sad_gorod','deck');
// INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Спорт і захоплення', 'sport_i_zahoplenya','kitesurfing');
// INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Одяг, взуття та аксесуари', 'odyag_vzutya_ta_aksesuary','checkroom');
// INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Краса та здоров'я', 'krasa_ta_zdorovya','face');
// INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Товари для дітей', 'tovari_dlya_ditey','child_friendly');
// INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Офіс, школа, книги', 'ofis_shkola_knigi','import_contacts');
// INSERT INTO MainGroups (mainGroupName, uri_name, logo) VALUES ('Побутова хімія', 'pobutova_himiya','science');


// INSERT INTO Groups (group_name, group_uri_name, logo) VALUES ('Смартфони, ТВ і Електроніка', 'smartfoni_tv_i_electronika', 'phone_android');
// INSERT INTO Groups (group_name, group_uri_name, logo) VALUES ('Товари для геймерів', 'tovari_dlya_geimerov','sports_esports');
// INSERT INTO Groups (group_name, group_uri_name, logo) VALUES ('Побутова техніка', 'pobutova_tehnika','local_laundry_service');
// INSERT INTO Groups (group_name, group_uri_name, logo) VALUES ('Товари для дому', 'tovari_dlya_domu','chair');
// INSERT INTO Groups (group_name, group_uri_name, logo) VALUES ('Інструменти та автотовари', 'instrumenti_ta_avtotovary','construction');
// INSERT INTO Groups (group_name, group_uri_name, logo) VALUES ('Сантехніка та ремонт', 'santehnika_ta_remont','bathtub');
// INSERT INTO Groups (group_name, group_uri_name, logo) VALUES ('Дача, сад, город', 'dacha_sad_gorod','deck');
// INSERT INTO Groups (group_name, group_uri_name, logo) VALUES ('Спорт і захоплення', 'sport_i_zahoplenya','kitesurfing');
// INSERT INTO Groups (group_name, group_uri_name, logo) VALUES ('Одяг, взуття та аксесуари', 'odyag_vzutya_ta_aksesuary','checkroom');
// INSERT INTO Groups (group_name, group_uri_name, logo) VALUES ('Краса та здоров'я', 'krasa_ta_zdorovya','face');
// INSERT INTO Groups (group_name, group_uri_name, logo) VALUES ('Товари для дітей', 'tovari_dlya_ditey','child_friendly');
// INSERT INTO Groups (group_name, group_uri_name, logo) VALUES ('Офіс, школа, книги', 'ofis_shkola_knigi','import_contacts');
// INSERT INTO Groups (group_name, group_uri_name, logo) VALUES ('Побутова хімія', 'pobutova_himiya','science');

// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Смартфони', 'smartfony', '378644481.jpg','2272a7df-dee0-11ee-a07b-13bc75150cfa');
// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Чохли з принтами', 'chohli_z_printamy', '409690866.webp','2272a7df-dee0-11ee-a07b-13bc75150cfa');
// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Мобільні телефони', 'mobilni_telefony', '378644481.jpg','2272a7df-dee0-11ee-a07b-13bc75150cfa');
// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Чохли для смартфонів', 'chohli_dlya_smartfoniv', '399789347.webp','2272a7df-dee0-11ee-a07b-13bc75150cfa');
// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Аксесуари', 'acsesuari', 'aksessuary_dlya_mobilnyh.jpg','2272a7df-dee0-11ee-a07b-13bc75150cfa');
// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Смарт-годинники', 'smart_godinniky', '378645138.jpg','2272a7df-dee0-11ee-a07b-13bc75150cfa');
// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Фітнес браслети', 'fitnes_braslety', '367323203.webp','2272a7df-dee0-11ee-a07b-13bc75150cfa');
// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Зарядні станції', 'zaryadny_stancii', 'zaryadnye_stancii.png','2272a7df-dee0-11ee-a07b-13bc75150cfa');
// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Power Bank', 'power_bank', '336305793.webp','2272a7df-dee0-11ee-a07b-13bc75150cfa');
// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Навушники', 'navushniky', '352930597.png','2272a7df-dee0-11ee-a07b-13bc75150cfa');
// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Портативна акустика', 'portativna_acustika', 'audiotehnika.jpg','2272a7df-dee0-11ee-a07b-13bc75150cfa');


// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Велика побутова техніка', 'velika_pobutova_tehnika', '325504069.png','2273aa3a-dee0-11ee-a07b-13bc75150cfa');
// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Вбудовувана побутова техніка', 'vbudovana_pobutova_tehnika', '325504076.png','2273aa3a-dee0-11ee-a07b-13bc75150cfa');
// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Кліматична техніка', 'klimatichna_tehnika', '372691761.png','2273aa3a-dee0-11ee-a07b-13bc75150cfa');
// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Догляд за домом і одягом', 'doglyad_za_domom_i_odyagom', '325504074.png','2273aa3a-dee0-11ee-a07b-13bc75150cfa');
// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Техніка для кухні', 'tehnika_dlya_kuhni', '325504079.png','2273aa3a-dee0-11ee-a07b-13bc75150cfa');
// INSERT INTO SubGroups (subgroup_name, group_uri_name, img, groupId) VALUES ('Краса та здоров``я', 'krasa_ta_zdorovya', '325504081.png','2273aa3a-dee0-11ee-a07b-13bc75150cfa');



// " ;
// $this->connect_db_query($sqlGroupsAndSubGroups) ;

// $sortString = "Пральні машини,Сушильні машини,Холодильники,Холодильники Side-by-Side,Бойлери,Витяжки,Посудомийні машини,Морозильні камери,Морозильні скрині,Винні шафи,Плити газові,Плити електричні,Плити комбіновані,Настільні плити,Електродуховки настільні,Льодогенератор,Аксесуари для великої побутової техніки,Холодильні шафи (вітрини)";
// $sqlsortString = $this->addSqlSortGroupString($sortString, 'f28428ad-def5-11ee-9da6-2f0792c834ab');       
// $this->connect_db_query($sqlsortString) ;
// $sortString = "Вбудовувана побутова техніка,Вбудовувані посудомийні машини,Вбудовувані холодильники,Вбудовувані духові шафи,Варильні поверхні,Варильні поверхні газові,Вбудовувані мікрохвильові печі,Вбудовувані кавоварки,Вбудовувані пральні машини,Вбудовувані морозильні камери,Вбудовувані винні шафи,Вбудовувані шафи для підігріву посуду";
// $sqlsortString = $this->addSqlSortGroupString($sortString, 'f28637d5-def5-11ee-9da6-2f0792c834ab');       
// $this->connect_db_query($sqlsortString) ;
// $sortString = "Кліматична техніка,Обігрівачі,Зволожувачі повітря,Вентилятори,Витяжні вентилятори,Кондиціонери,Очищувачі повітря,Газові котли,Електричні котли,Твердопаливні котли,Аксесуари до котлів,Водонагрівачі газові,Кліматичні комплекси,Осушувачі повітря,Метеостанції,Термометри-гігрометри";
// $sqlsortString = $this->addSqlSortGroupString($sortString, 'f288341a-def5-11ee-9da6-2f0792c834ab');       
// $this->connect_db_query($sqlsortString) ;

// $sortString = "Samsung,Xiaomi,Google,OnePlus,Motorola,Asus,Oukitel,Blackview,Nothing,Honor,ZTE";        
// $sqlsortString = $this->addSqlSortGroupString($sortString, 'a7dd18e6-def5-11ee-9da6-2f0792c834ab');       
// $this->connect_db_query($sqlsortString) ;
// $sortString = "Apple,Samsung,Xiaomi";        
// $sqlsortString = $this->addSqlSortGroupString($sortString, 'f26cfb21-def5-11ee-9da6-2f0792c834ab');       
// $this->connect_db_query($sqlsortString) ;
// $sortString = "Nokia,Sigma-Mobile,Philips,Alcatel,TECNO";        
// $sqlsortString = $this->addSqlSortGroupString($sortString, 'f270d27e-def5-11ee-9da6-2f0792c834ab');       
// $this->connect_db_query($sqlsortString) ;
// $sortString = "Накладка на задню частину,Чохол-книжка,Сумка-чохол";        
// $sqlsortString = $this->addSqlSortGroupString($sortString, 'f27346c0-def5-11ee-9da6-2f0792c834ab');       
// $this->connect_db_query($sqlsortString) ;
// $sortString = "Захисне скло,Зарядні пристрої,Кабелі,Тримачі та док-станції,Адаптери";        
// $sqlsortString = $this->addSqlSortGroupString($sortString, 'f2759ca3-def5-11ee-9da6-2f0792c834ab');       
// $this->connect_db_query($sqlsortString) ;
// $sortString = "Apple,Samsung,Mobvoi,Garmin,Xiaomi,AmazFit,Haylou,Proove";        
// $sqlsortString = $this->addSqlSortGroupString($sortString, 'f277f3e7-def5-11ee-9da6-2f0792c834ab');       
// $this->connect_db_query($sqlsortString) ;
// $sortString = "Xiaomi,Samsung,Lemfo,Honor";        
// $sqlsortString = $this->addSqlSortGroupString($sortString, 'f27a30bc-def5-11ee-9da6-2f0792c834ab');       
// $this->connect_db_query($sqlsortString) ;
// $sortString = "Менше 700 Вт,700-1800 Вт,2000 Вт,Більше 2000 Вт";        
// $sqlsortString = $this->addSqlSortGroupString($sortString, 'f27c3752-def5-11ee-9da6-2f0792c834ab');       
// $this->connect_db_query($sqlsortString) ;
// $sortString = "10000-15999 мАч,20000 мАч та більше,3000-4999 мАч,5000-9999 мАч,16000-19999 мАч,Менше 3000 мАч";        
// $sqlsortString = $this->addSqlSortGroupString($sortString, 'f27e01c4-def5-11ee-9da6-2f0792c834ab');       
// $this->connect_db_query($sqlsortString) ;
// $sortString = "TWS,Вакуумні,Повнорозмірні,Геймерські,Аксесуари для навушників і гарнітур";        
// $sqlsortString = $this->addSqlSortGroupString($sortString, 'f2800537-def5-11ee-9da6-2f0792c834ab');       
// $this->connect_db_query($sqlsortString) ;
// $sortString = "JBL,Bose,Marshall,SVEN,Gelius";        
// $sqlsortString = $this->addSqlSortGroupString($sortString, 'f2821de4-def5-11ee-9da6-2f0792c834ab');       
// $this->connect_db_query($sqlsortString) ;




// }
