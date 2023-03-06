# CloudPayments модуль для OpenCart
Модуль позволит с легкостью добавить на ваш сайт оплату банковскими картами через платежный сервис CloudPayments. 
Для корректной работы модуля необходима регистрация в сервисе.

Порядок регистрации описан в [документации CloudPayments](https://cloudpayments.ru/Docs/Connect)

### Возможности
* Одностадийная схема оплаты;
* Двухстадийная схема оплаты;
* Выбор дизайна виджета оплаты;
* Отмена, подтверждение и возврат платежей из ЛК CMS;
* Локализация виджета оплаты;
* Поддержка онлайн-касс (ФЗ-54);
* Настройка НДС для службы доставки;
* Теги способа и предмета расчета;  
* Отправка чеков по email;
* Отправка чеков по SMS;

### Совместимость
OpenCart v.2.2 и выше;

### Установка через панель управления

В панели адмниистратора зайти в раздел "Модули/Расширения" -> "Установка расширений" и загрузить архив.

### Ручная установка

Распаковать из архива каталог upload и загрузить в корень OpenCart.
Если у вы используете opencart v.2.3, то используйте upload из каталога for 2.3 only.
Если у вы используете opencart v.2.2, то используйте upload из каталога for 2.2 only.

### Настройка модуля

1. Перейти в настройки модуля "Модули/Расширения" -> "Модули/Расширения" -> "Оплата".
Выбрать CloudPayments и активировать модуль.
2. Зайти в настройки модуля и указать:
    * Идентификатор сайта — Public id сайта из личного кабинета CloudPayments
    * Секретный ключ — API Secret из личного кабинета CloudPayments
    * Статус - включено
    
    Затем сохранить введенные параметры.
    
    Дополнительно можно также указать: регионы, для которых будет действовать метод оплаты,
    минимальную сумму заказа, порядок сортировки при выводе методов оплаты.
    А также включить двухстадийную оплату, формирвание онлайн-чека и настроить требуемые статусы заказа
    на определенные события.
3. В личном кабинете CloudPayments указать URL уведомлений со вкладки "Уведомления"    

### Двухстадийная оплата

В этом режиме оплата происходит в два этапа: авторизация платежа (блокировка суммы на карте покупателя)
и подтверждение списания.
Для работы модуля в этом режиме могут потребоваться дополнительные статусы заказа:

* Авторизован — На данный статус заказ переводится при получении уведомления об авторизации оплаты.
    По умолчанию заказ переводится в статус "Ожидание";
* Подтвержден — При перевода заказа на данный статус отправляется запрос на подтверждение оплаты.
    Необходим если требуется подтверждать заказ до отправки.
    По умолчанию оплата подтверждается при смене статуса на "Сделка завершена".
        
Данные статусы можно создать в "Система" -> "Локализация" -> "Статусы заказов".
А настроить их на требуемые события в настройках модуля (вкладка "Статусы"). 
Также в настройках модуля требуется включить двухстадийную оплату установив значение
соответствущего параметра в "включено".

### Интеграция с онлайн-кассой (Россия)

Модуль позволяет интегрировать онлайн-кассу при оплате и отменах платежей.
Для этого подключить кассу в личном кабинете CloudPayments https://cloudpayments.ru/Docs/Kassa и указать дополнительные настройки модуля:

* Формировать онлайн-чек — Включено
* Ставка НДС — Указание ставки НДС.
Все возможные значения указаны в документации https://cloudpayments.ru/Docs/Kassa#data-format
* Ставка НДС для доставки — Указание отдельной ставки НДС для доставки.
Если доставка платная, то она в чеке оформляется отдельной строкой со своей ставкой НДС.
Значения аналогично ставке НДС для товаров.
* Система налогообложения — Тип системы налогообложения.
Возможные значения перечислены в документации CloudPayments https://cloudpayments.ru/Docs/Directory#taxation-system
* Способ расчета — признак способа расчета для товаров;
* Предмет расчета — признак предмета расчета для товаров;
* Статус доставки - **Доставлен** (Или **Shipped** на eng версии админ панели).  
_Отдельный статус доставки необходим при формировании двух чеков: один чек - при поступлении денег от покупателя, второй при отгрузке товара. Отправка второго чека возможна при следующих способах расчета: Предоплата, Предоплата 100%, Аванс._  

### Интеграция с онлайн-кассой (Узбекистан)

Модуль позволяет интегрировать онлайн-кассу при оплате и отменах платежей.
Для этого обратитесь к вашему менеджеру, он подключит фискализацию.

#### В настройках модуля, в разделе "Онлайн-касса":

* Выберите страну "Узбекистан"
* Ставка НДС — без НДС, 0% НДС или 12% НДС
* Ставка НДС для доставки — без НДС, 0% НДС или 12% НДС
* Для доставки установлен код ИКПУ 10112006002000000 с кодом упаковки 1209779, подробнее на https://tasnif.soliq.uz/attribute/10112006002000000
* ИНН организации — укажите ваш ИНН (если вы ООО) или ПИН ФЛ (если вы самозанятый или ИП)

#### В каталоге, в разделе "Атрибуты":

* Создайте атрибут с точным названием "ИКПУ"
* Создайте атрибут с точным названием "Код упаковки"

#### В каталоге, в разделе "Товары"

* Укажите каждому товару соответствующий код ИКПУ и код упаковки через вкладку "Атрибуты"

### Уведомления о событиях

В системе предусмотрено несколько видов уведомлений: для проверки возможности выполнить оплату, для информирования об успешных и неуспешных платежах, а также для информирования о выданных кассовых чеках.
В личном кабинете CloudPayments зайдите в настройки сайта, пропишите в настройках уведомления, как описано на вкладке "уведомления" настройки модуля.

== Changelog ==  
= 2.0 =
* Добавлены теги способов и предметов расчета;
* Устранены некоторые ошибки с мультивалютностью;
* Устранены некоторые ошибки с кассовыми чеками;

= 1.2 =
* Устранены некоторые ошибки;
* Публикация плагина на маркетплейс.

= 1.0 =
* Публикация плагина на [GitHub](https://github.com/cloudpayments/CMS-OpenCart-CP). 