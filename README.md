Добавить в таблицу статусов ЕБК параметр "наименование компании" в сокращенном виде, под строку ИНН.
Пример компании: ООО "ПРО АВТО"
Пример ИП: ИП Иванов А.А.
Т.е. сначала идет ИНН, сокращенное наименование компании, индикатор

Use Case:

1. Зайти в сущность "Сделки"
2. Открыть фильтр
3. Поставить значение в фильтре "ЕБК.Общий" по "Действующим" клиентам
4. Нажать "Найти"
5. Открыть карточку любой компании
6. Открыть вкладку "Статусы ЕБК"

Ожидаемый результат:

В столбце ИНН помимо самого ИНН и индикатора клиента (Зеленый,серый,черный) - должно быть название компании, ООО или ИП в сокращенном виде
Порядок такой: ИНН, название компании, индикатор
Если индикатора в столбце ИНН нет, то это значит, что 1С не отдает по этому ИННу данные.
Если нет ИНН, то это значит, что поле реквизитов в карточке компании не заполнено
