# Distance Calculator API

This API accepts an array of distances and returns the sum of them using the unit specified for the result.

## How do I want to approach this project?

Because of the project size, I am going to create a new API using [Lumen](https://lumen.laravel.com/).

### How to specify distances?

They must be specified as json objects with two properties: `value` and `unit`.

- **value**: must be an int/float value.
- **unit**: must be the string `meters` or `yards`.

```json
{
  'value': 1.00,
  'unit': 'meters'
},
```

### How to get the sum of distances?

The API accepts a json object with two properties: `distances` and `resultUnit`.

- **distances**: array of distance json objects. It is mandatory to specify at least one `Distance`.
- **resultUnit**: must be the string `meters` or `yards`.

```json
{
  'distances': [
    {
      'value': 1.23,
      'unit': 'meter'
    },
    {
      'value': 4.56,
      'unit': 'yard'
    }
  ],
  'resultUnit': 'yard'
}
```

If it is indicated just one distance, it will be returned using the `resultUnit`.

### Which is the route to get the sum?

The json object must be sent using POST to this URL:

```
https://distancecalculator.auret.es/api/sum
```

### Future improvements

If I have enough time, I would like to use an Enum to specify Units.
