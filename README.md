# PHP Example


## Requirements

- Docker

## Overview

The PHP Example project is a small REST API.

- GET /               -> Dummy data
- GET /1111           -> Get an order by its ID 
- GET /products/1111  -> Get a product by its ID

## Running the app
Run these commands in order

`make up`

`make composer-install`

`make migrate`

`make seed` -> create 1 order with N items

## Tools
`make test` -> Run pest tests

`make k6` -> Check performance 

See results:

URL: http://localhost:80
Adminer: http://localhost:3333

## Examples

```bash
$ curl -X GET localhost:80/1
[
    {
        "id": 1,
        "total": "92.63",
        "currency": "CZK",
        "state": "new",
        "createdAt": "2024-07-14 17:41:18",
        "items": [
            {
                "id": 5,
                "name": "Russell Gutkowski",
                "price": "86.08",
                "currency": "CZK"
            },
            {
                "id": 6,
                "name": "Isobel Jacobson",
                "price": "88.62",
                "currency": "CZK"
            },
            {
                "id": 7,
                "name": "Verna Terry",
                "price": "17.81",
                "currency": "CZK"
            },
            {
                "id": 8,
                "name": "Katrine Gutmann",
                "price": "25.73",
                "currency": "CZK"
            },
            {
                "id": 9,
                "name": "Mr. Trace Crist",
                "price": "1.12",
                "currency": "CZK"
            }
        ]
    }
]
```

```bash
$ curl -X GET localhost:80/products/1
[
    {
        "id": 1,
        "name": "Russell Gutkowski",
        "price": 86.0,
        "currency": "CZK",
        "createdAt": "2024-07-14 17:41:18"
    }
]
```
