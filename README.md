# Information

Интеграция цитаты в статью.

## Install

1. Загрузите папки и файлы в директорию `extensions/MW_EXT_Quote`.
2. В самый низ файла `LocalSettings.php` добавьте строку:

```php
wfLoadExtension( 'MW_EXT_Quote' );
```

## Syntax

```html
<quote source="[SOURCE]" date="[DATE]" sign="[PERSON]">[CONTENT]</quote>
```
