# carbon-field-serialized-data
Extends Carbon fields with a Serialized Data field.

This field is used for displaying saved meta in Serialized Format from Database. This field extends the "HTML" field, and does not make changes to Database.

Usage:

```
Carbon_Field::factory('serialized_data', 'serialized_results', 'Serialized Results'),
```

Filters:
`crb_serialized_data_field_output` - you can use this filter to setup field output. By default will be displayed the result from "maybe_unserialize"