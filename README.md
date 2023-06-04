# Тестовое задание.

## ТЗ backend v2 email. «Backend-разработчик»

### Что сделано

- Добавлены FK (внешние ключи). Это сделано для выполнения задачи согласно одной из возможной интерпретации пункта 1.
  задания. Кроме этого смысла в этих ключах и их индексов нет. И они скорей не желательны при больших объемах данных, а
  консистентность можно контролировать валидацией в Yii2 при записи (хотя это и не так надежно как с FK).
- Были сгенерированы демо данные (в т.ч. около 1М записей в flight_segment). Эксперименты проводились на ноутбуке Ryzen
  5, 16GB, SSD NVME, WIN11, WSL2, Docker. В коде только MySql 8, но в тестах использовалась и MySql 5.6.34 в которой был
  создан исходный дамп. Проведены следующие эксперименты:
    - Добавление новых ключей и удаление имеющихся. Написание запросов с явным указанием используемыз ключей. Результаты
      показали, что существующие в исходном дампе ключи оказались достаточны. И добавление новых ключей и управление
      ключами не дали существенного улучшения. Возможно при наличии особых "не равномерностей" значений и частых
      специфичных запросов этот способ дал бы результат в каких то случаях. В итоге новые ключи не добавлены (кроме тех
      что описаны в первом пункте)
    - Т.к. MySql нет индексов на колонки в разных таблицах, то была создана отдельная таблица с данными достаточными для
      фильтрации. Результат показал схожею производительность с окончательным вариантом и этот код не вошел в коммит.
    - Был добавлен дата провайдер не совершающий SQL зарос с `COUNT(*)`. Это дало увеличение скорости запросов до 10-ти
      раз для первых страниц данных при большом количестве строк подходящих под фильтр. Это провайдер активируется
      чекбоксом в фильтре. На данных из исходного дампа (их не много) этот эффект не столь очевиден.
- т.к. работа со страницей не всегда связана с изменением параметров фильтра, то с целью уменьшения запросов для
  значений фильтров эти значения запрашиваются по AJAX.
- Удалены страницы и тесты создаваемые при установки Yii2.

### Не сделано

- Проверка значений фильтра в

```php
TripSearch::rules()
```

Причины указаны в TODO №346507.

- Окончательный внешний вид для пагинации без запроса `COUNT(*)` т.к. для цели демонстрации текущего вида достаточно.
- Вынос демо данных в отдельные миграции. Не сделано для простоты запуска.
- Интернационализации не сделана т.к. многие сущности не существуют в сокровенной версии и их корректные имена не
  известны.