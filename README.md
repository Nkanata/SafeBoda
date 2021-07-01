# Adding  event 

## POST to http://$host/AddEvent.php

### Sample data.
```
{
    "eventName": "Safaricom Open Day",
    "coordinates": "40.71727401 -74.00898606",
    "eventDate": "2021-7-31 18:00:00",
    "promoCodes": 10
}
```

## Generating promocodes
## POST to http://$host/AddPromoCodes.php

### Sample Data
```
{
    "numberofpromocodes": 10,
    "event": "Safaricom Open Day",
    "amount": "100",
    "radius": "70",
    "expiry": "2021-07-30 23:28:34"

}
```

## Get All Promocodes

### GET http://$host/PromoCodeOps.php?getall=TRUE

## Get all active promocodes

### GET http://$host/PromoCodeOps.php?getactive=TRUE

## Deactivate Promo Code

### POST http://$host/PromoCodeOps.php

## sample Data 

```
{
    "deactivate": "true",
    "promocode": "c4e519"
}
```

### Configure Promo Code Radius

### POST to http://$host/ConfigureRadius.php

### Sample Data 
```
 {
    "PromoCode" : "c4e519",
    "radius": 60
}
```

## Check Validity 

## POST to http://$host/CheckValidity.php

### Sample Data
```
{
    "origin": "40.71727401 -74.00898606",
    "destination": "40.71727401 -74.10898606",
    "promo_code": "8b0a6f"
    
}
```
