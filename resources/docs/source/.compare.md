---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](auditingWithTenancy/docs/collection.json)

<!-- END_INFO -->

#Manage Subscriber (Tenant) Office Info


APIs To Manage Subscriber (Tenant) Office Info
<!-- START_9ac2c8f46e8831f29e2d725a4cbd5add -->
## Get Office Info
Ziggy route : axios.get(route(&#039;owner.officeInfo.index&#039;)).

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/OwnerAdmin/OfficeInfo/voluptatibus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/OwnerAdmin/OfficeInfo/voluptatibus"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "OfficeInfo": {
        "id": 1,
        "type": "بيانات المكتب",
        "name": "مكتب خليل التهامي",
        "name_english": null,
        "value": null,
        "logo": null,
        "bank_name": null,
        "bank_name_english": null,
        "bank_account_number": null,
        "created_at": null,
        "updated_at": null
    }
}
```

### HTTP Request
`GET OwnerAdmin/OfficeInfo/{TenantID}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `TenantID` |  required  | param of the Tenant (subscriber ID).

<!-- END_9ac2c8f46e8831f29e2d725a4cbd5add -->

<!-- START_0aae00b71e5df1a38418896455aa1dce -->
## store Office Info
Ziggy route : axios.post(route(&#039;owner.officeInfo.store&#039;),formData).

> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/OwnerAdmin/StoreOfficeInfo/et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"ut","name_english":"enim","bank_name":"atque","bank_name_english":"sunt","bank_account_number":"reiciendis","logo":"rerum"}'

```

```javascript
const url = new URL(
    "auditingWithTenancy/OwnerAdmin/StoreOfficeInfo/et"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "ut",
    "name_english": "enim",
    "bank_name": "atque",
    "bank_name_english": "sunt",
    "bank_account_number": "reiciendis",
    "logo": "rerum"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST OwnerAdmin/StoreOfficeInfo/{TenantID}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `TenantID` |  required  | param of the Tenant (subscriber ID).
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | The Office Name in arabic.
        `name_english` | string |  required  | The Office Name in english.
        `bank_name` | string |  required  | The Office Bank Name in arabic.
        `bank_name_english` | string |  required  | The Office Bank Name in arabic.
        `bank_account_number` | string |  required  | The Office Bank number.
        `logo` | required |  optional  | The Office Logo.
    
<!-- END_0aae00b71e5df1a38418896455aa1dce -->

<!-- START_499a6ce5dbcb5b0970147f857652ec73 -->
## update Office Info
Ziggy route : axios.post(route(&#039;owner.officeInfo.update&#039;),formData).

<br>
formData.append('_method',"PATCH").

> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/OwnerAdmin/UpdateOfficeInfo/voluptatem" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"in","name_english":"distinctio","bank_name":"voluptatem","bank_name_english":"et","bank_account_number":"cum","logo":"consectetur"}'

```

```javascript
const url = new URL(
    "auditingWithTenancy/OwnerAdmin/UpdateOfficeInfo/voluptatem"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "in",
    "name_english": "distinctio",
    "bank_name": "voluptatem",
    "bank_name_english": "et",
    "bank_account_number": "cum",
    "logo": "consectetur"
}

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH OwnerAdmin/UpdateOfficeInfo/{TenantID}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `TenantID` |  required  | param of the Tenant (subscriber ID).
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | The Office Name in arabic.
        `name_english` | string |  required  | The Office Name in english.
        `bank_name` | string |  required  | The Office Bank Name in arabic.
        `bank_name_english` | string |  required  | The Office Bank Name in arabic.
        `bank_account_number` | string |  required  | The Office Bank number.
        `logo` | required |  optional  | The Office Logo.
    
<!-- END_499a6ce5dbcb5b0970147f857652ec73 -->

#Manage Subscriptions (Tenants)


APIs To Manage Subscriptions
<!-- START_e8b58968ffdcd2c2b3a5db21790a6ddd -->
## Retrieve subscribers (Tenants) paginated
Note : Return views/Tenants/index.blade.php add your component their ----------
Note : return response if request expects json ----------
[id , name, email, status (pending,active,expired), subscription_price,subscription_date (TimeStamps),subscription_end_date,created_at,tenancy_db_name,domains[] ]

Ziggy route : axios.get(route('owner.subscriptions.index'))

--------------------------------- EXAMPLE OF data[0] in response ---------------------------------

 "id": "KhalilOffice",<br>
 "name": "khalil ahmed",<br>
 "email": "",<br>
 "status": "pending",<br>
 "number_of_branches": 0,<br>
  "subscription_price": 3000,<br>
 "subscription_date": null,<br>
 "subscription_end_date": null,<br>
 "created_at": "2021-04-24T00:16:22.000000Z",<br>
 "updated_at": "2021-04-22T20:12:05.000000Z",<br>
 "tenancy_db_name": "tenantKhalilOffice",<br>
  <br>
 "domains": [
<br>
     {
     "id": 7,
     "domain": "khaliloffice",
     "tenant_id": "KhalilOffice",
     "created_at": "2021-04-22T20:12:09.000000Z",
     "updated_at": "2021-04-22T20:12:09.000000Z"
     }
<br>
        ]

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/OwnerAdmin/Subscriptions?SearchTenantName=nihil&CreationDate=quasi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/OwnerAdmin/Subscriptions"
);

let params = {
    "SearchTenantName": "nihil",
    "CreationDate": "quasi",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET OwnerAdmin/Subscriptions`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `SearchTenantName` |  optional  | string optional param if there is a search with Name.
    `CreationDate` |  optional  | datetime optional param if there is a search with creation date.

<!-- END_e8b58968ffdcd2c2b3a5db21790a6ddd -->

<!-- START_c8f1d47958851ab3ddb68b1a6918c6cb -->
## create new subscriber blade,
 route : route(&#039;owner.subscriptions.create&#039;),
 the create blade /resources/views/Owner/Tenants/create.blade.php --&gt; add your component their

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/OwnerAdmin/Subscriptions/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/OwnerAdmin/Subscriptions/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET OwnerAdmin/Subscriptions/create`


<!-- END_c8f1d47958851ab3ddb68b1a6918c6cb -->

<!-- START_682050dba3b0e6f761341cfdb8bfe4d8 -->
## store new subscriber | Return NewSubscriber.

Ziggy route : axios.post(route('owner.subscriptions.store'),formData).

> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/OwnerAdmin/Subscriptions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"dignissimos","domain":"eveniet","name":"rerum","email":"praesentium","password":"ut","status":"iure","number_of_branches":3,"subscription_price":162.6,"subscription_period_in_days":4,"subscription_date":"dolor","subscription_end_date":"et"}'

```

```javascript
const url = new URL(
    "auditingWithTenancy/OwnerAdmin/Subscriptions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "dignissimos",
    "domain": "eveniet",
    "name": "rerum",
    "email": "praesentium",
    "password": "ut",
    "status": "iure",
    "number_of_branches": 3,
    "subscription_price": 162.6,
    "subscription_period_in_days": 4,
    "subscription_date": "dolor",
    "subscription_end_date": "et"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST OwnerAdmin/Subscriptions`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | string |  required  | The Domain of the subscriber example KhalilOffice Note the full Office Url Will be KhalilOffice.Almudaqiq.com..
        `domain` | string |  required  | The Domain of the subscriber example KhalilOffice Note the full Office Url Will be KhalilOffice.Almudaqiq.com..
        `name` | string |  required  | The Name of the subscriber.
        `email` | string |  required  | The Password of the subscriber.
        `password` | string |  required  | The Password of the subscriber.
        `status` | string |  required  | one of (pending,active) it will be the current status of the subscriber.
        `number_of_branches` | integer |  required  | The Number Of Branches of the subscriber.
        `subscription_price` | float |  required  | The subscription_price.
        `subscription_period_in_days` | integer |  required  | The subscription period in days.
        `subscription_date` | string |  required  | The Password of the subscriber.
        `subscription_end_date` | string |  required  | The Password of the subscriber.
    
<!-- END_682050dba3b0e6f761341cfdb8bfe4d8 -->

<!-- START_59c6b1cd59eb8d4c9f9dc0920a02df77 -->
## Retrieve One Tenant with his domains.

<br>
then Returns Blade Owner/Tenants/edit.blade.php.
<br>
Add Vue Component Their
<br>
route : route('owner.subscriptions.edit'),

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/OwnerAdmin/Subscriptions/1/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/OwnerAdmin/Subscriptions/1/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET OwnerAdmin/Subscriptions/{Subscription}/edit`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `TenantID` |  required  | param of the Tenant (subscriber ID).

<!-- END_59c6b1cd59eb8d4c9f9dc0920a02df77 -->

<!-- START_ef24b24ac90d54c47b0252919214d35c -->
## Update the info of the subscriber and its domain.

Ziggy route : axios.post(route('owner.subscriptions.update',TenantID),formData).
<br>
formData.append('_method',"PATCH").
<br>

> Example request:

```bash
curl -X PUT \
    "auditingWithTenancy/OwnerAdmin/Subscriptions/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"quia","email":"sint","password":"et","status":"expedita","number_of_branches":12,"subscription_price":126793466.00043,"subscription_period_in_days":18,"subscription_date":"velit","subscription_end_date":"consequatur"}'

```

```javascript
const url = new URL(
    "auditingWithTenancy/OwnerAdmin/Subscriptions/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "quia",
    "email": "sint",
    "password": "et",
    "status": "expedita",
    "number_of_branches": 12,
    "subscription_price": 126793466.00043,
    "subscription_period_in_days": 18,
    "subscription_date": "velit",
    "subscription_end_date": "consequatur"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT OwnerAdmin/Subscriptions/{Subscription}`

`PATCH OwnerAdmin/Subscriptions/{Subscription}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `TenantID` |  required  | param of the Tenant (subscriber ID).
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | The Name of the subscriber.
        `email` | string |  required  | The Password of the subscriber.
        `password` | string |  required  | The Password of the subscriber.
        `status` | string |  required  | one of (pending,active) it will be the current status of the subscriber.
        `number_of_branches` | integer |  required  | The Number Of Branches of the subscriber.
        `subscription_price` | float |  required  | The subscription_price.
        `subscription_period_in_days` | integer |  required  | The subscription period in days.
        `subscription_date` | string |  required  | The Password of the subscriber.
        `subscription_end_date` | string |  required  | The Password of the subscriber.
    
<!-- END_ef24b24ac90d54c47b0252919214d35c -->

<!-- START_5c2e975b759acc84d6a199b22d5ee50c -->
## Delete the info of the subscriber and its domain
Ziggy route : axios.delete(route(&#039;owner.subscriptions.destroy&#039;,TenantID),formData).

<br>

> Example request:

```bash
curl -X DELETE \
    "auditingWithTenancy/OwnerAdmin/Subscriptions/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/OwnerAdmin/Subscriptions/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE OwnerAdmin/Subscriptions/{Subscription}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `TenantID` |  required  | param of the Tenant (subscriber ID).

<!-- END_5c2e975b759acc84d6a199b22d5ee50c -->

#Manage subscribed office branches


APIs To Manage subscribed office branches
<!-- START_77783450c872d61be1f885acb9512f69 -->
## Retrieve subscriber (Tenant) All Office Branches,
return response json.

<br>
Ziggy route : axios.get(route('owner.officeInfo.index')).
<br>
reponse {
 "OfficeBranches": [
<br>
{
"id": 1,
"name": "الرياض",
"address": "عنوان - الرياض",
"is_main":1
"created_at": "2021-04-14T22:43:23.000000Z",
"updated_at": null
},
<br>
{
"id": 2,
"name": "الدمام",
"address": "عنوان - الخبر",
"is_main":0
"created_at": "2021-04-28T22:43:26.000000Z",
"updated_at": null
}
<br>
]
}

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/OwnerAdmin/subscriber/id/OfficeBranches" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/OwnerAdmin/subscriber/id/OfficeBranches"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET OwnerAdmin/subscriber/{TenantID}/OfficeBranches`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `TenantID` |  required  | The Id of the subscriber (Tenant).

<!-- END_77783450c872d61be1f885acb9512f69 -->

<!-- START_3628400762398f1b1a2b8cfb189bafd2 -->
## store new Branch | Return The NewOfficeBranch.

Ziggy route : axios.post(route('owner.OfficeBranches.store'),formData).

> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/OwnerAdmin/subscriber/reprehenderit/OfficeBranches" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"et","address":"quo","is_main":false}'

```

```javascript
const url = new URL(
    "auditingWithTenancy/OwnerAdmin/subscriber/reprehenderit/OfficeBranches"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "et",
    "address": "quo",
    "is_main": false
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST OwnerAdmin/subscriber/{TenantID}/OfficeBranches`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `TenantID` |  required  | The Id of the subscriber (Tenant).
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | The Office Name.
        `address` | string |  required  | The Office address.
        `is_main` | boolean |  required  | tell if the branch is main branch.
    
<!-- END_3628400762398f1b1a2b8cfb189bafd2 -->

<!-- START_81583cb60e8418f26b3ce863a79fe84d -->
## update Office Branch | Return The UpdatedOfficeBranch.

Ziggy route : axios.post(route('owner.OfficeBranches.update'),formData).
<br>
formData.append('_method',"PATCH").
<br>

> Example request:

```bash
curl -X PUT \
    "auditingWithTenancy/OwnerAdmin/subscriber/adipisci/OfficeBranches/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"eius","address":"ut","is_main":true}'

```

```javascript
const url = new URL(
    "auditingWithTenancy/OwnerAdmin/subscriber/adipisci/OfficeBranches/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "eius",
    "address": "ut",
    "is_main": true
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT OwnerAdmin/subscriber/{TenantID}/OfficeBranches/{OfficeBranch}`

`PATCH OwnerAdmin/subscriber/{TenantID}/OfficeBranches/{OfficeBranch}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `TenantID` |  required  | The Id of the subscriber (Tenant).
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | The Office Name.
        `address` | string |  required  | The Office address.
        `is_main` | boolean |  required  | tell if the branch is main branch.
    
<!-- END_81583cb60e8418f26b3ce863a79fe84d -->

<!-- START_3152c87068628edddc718d555001e482 -->
## delete Office Branch

Ziggy route : axios.delete(route('owner.OfficeBranches.destroy',TenantID)).
<br>
formData.append('_method',"delete").
<br>

> Example request:

```bash
curl -X DELETE \
    "auditingWithTenancy/OwnerAdmin/subscriber/modi/OfficeBranches/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/OwnerAdmin/subscriber/modi/OfficeBranches/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE OwnerAdmin/subscriber/{TenantID}/OfficeBranches/{OfficeBranch}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `TenantID` |  required  | The Id of the subscriber (Tenant).
    `OfficeBranchID` |  required  | The Id of the Branch that will be deleted .

<!-- END_3152c87068628edddc718d555001e482 -->

#Owner Admin DashBoard


API Send All Tenants Stats
<!-- START_c7025f946b82b41849ffa8137f2720eb -->
## Retrieve Tenants Stats

[Total Number Of Tenants , Pending Requests To Join, Active Tenants, Expired Tenants, The Money Made By Subscriptions This Month]
Ziggy route : axios.get(route('owner.dashboard'))

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/OwnerAdmin/dashboard" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/OwnerAdmin/dashboard"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "TenantsStats": {
        "TotalTenants": 4,
        "PendingTenants": 4,
        "ActiveTenants": 0,
        "ExpiredTenants": 0,
        "CurrentMonthIncome": 12000
    }
}
```

### HTTP Request
`GET OwnerAdmin/dashboard`


<!-- END_c7025f946b82b41849ffa8137f2720eb -->

#Tenants users to Manage subscribing


views and APIs To view & store & update Subscriptions
<!-- START_71457262d9278ebb687aaa206796aecf -->
## return view that shows the subscribing Main page ,
 route : route(&#039;home.subscriptions.index&#039;),
 the index blade /resources/views/FrontPreviews/Subscriptions/index.blade.php --&gt; add your component their

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/home/subscriptions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/home/subscriptions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET home/subscriptions`


<!-- END_71457262d9278ebb687aaa206796aecf -->

<!-- START_b3ec79274553eb13cf4981db0d080847 -->
## return view that shows the create new subscription page.

<br>
 route : route('home.subscriptions.create'),
 the index blade /resources/views/FrontPreviews/Subscriptions/create.blade.php --> add your component their

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/home/subscriptions/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/home/subscriptions/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET home/subscriptions/create`


<!-- END_b3ec79274553eb13cf4981db0d080847 -->

<!-- START_5f06288aaef3c177580a49cdc5751fdb -->
## Store New subscription.

<br>
 route : route('home.subscriptions.store'),

> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/home/subscriptions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"animi"}'

```

```javascript
const url = new URL(
    "auditingWithTenancy/home/subscriptions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "animi"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST home/subscriptions`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | string |  required  | The Domain of the subscriber example KhalilOffice Note the full Office Url Will be KhalilOffice.Almudaqiq.com..
    
<!-- END_5f06288aaef3c177580a49cdc5751fdb -->

<!-- START_e6ed9f871e33539b405e25a3355bdd27 -->
## return view that shows the current tenant subscription details page.&lt;br&gt;
 route : route(&#039;home.subscriptions.edit&#039;,{&#039;TenantID&#039;:TenantID}). &lt;br&gt;
 the edit blade /resources/views/FrontPreviews/Subscriptions/edit.blade.php --&gt; add your component their.

<br>
 <your-component-name :Subscriper="{{$Subscriber}}"></your-component-name>

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/home/subscriptions/minus/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/home/subscriptions/minus/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "No query results for model [App\\Tenant]."
}
```

### HTTP Request
`GET home/subscriptions/{TenantID}/edit`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `TenantID` |  required  | param of the Tenant (subscriber ID).

<!-- END_e6ed9f871e33539b405e25a3355bdd27 -->

<!-- START_be755a08b9a20838272403f7380d52b7 -->
## update New subscription.

route : route('home.subscriptions.update'),

> Example request:

```bash
curl -X PUT \
    "auditingWithTenancy/home/subscriptions/soluta" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"neque","email":"veritatis","password":"suscipit"}'

```

```javascript
const url = new URL(
    "auditingWithTenancy/home/subscriptions/soluta"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "neque",
    "email": "veritatis",
    "password": "suscipit"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT home/subscriptions/{TenantID}`

`PATCH home/subscriptions/{TenantID}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `TenantID` |  required  | param of the Tenant (subscriber ID),
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | The Name of the subscriber.
        `email` | string |  required  | The Email of the subscriber.
        `password` | string |  required  | The Password of the subscriber.
    
<!-- END_be755a08b9a20838272403f7380d52b7 -->

#general


<!-- START_9a2ce5003ff2eccb00ffbee6b668d54e -->
## maileclipse
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/maileclipse" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET maileclipse`


<!-- END_9a2ce5003ff2eccb00ffbee6b668d54e -->

<!-- START_1dbe86d638df32260eac1dde1338a97f -->
## maileclipse/templates
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/maileclipse/templates" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/templates"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET maileclipse/templates`


<!-- END_1dbe86d638df32260eac1dde1338a97f -->

<!-- START_d0e818a70d9b7bd1ac111481bd6e8e23 -->
## maileclipse/templates/new
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/maileclipse/templates/new" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/templates/new"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET maileclipse/templates/new`


<!-- END_d0e818a70d9b7bd1ac111481bd6e8e23 -->

<!-- START_11e898fb0af37e7436af56135813c2ec -->
## maileclipse/templates/new/{type}/{name}/{skeleton}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/maileclipse/templates/new/1/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/templates/new/1/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET maileclipse/templates/new/{type}/{name}/{skeleton}`


<!-- END_11e898fb0af37e7436af56135813c2ec -->

<!-- START_57c2d6acbef513122d9fa4e7a924c2fc -->
## maileclipse/templates/edit/{templatename}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/maileclipse/templates/edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/templates/edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET maileclipse/templates/edit/{templatename}`


<!-- END_57c2d6acbef513122d9fa4e7a924c2fc -->

<!-- START_63d50d240d07520e0fe7cb50bb8194ff -->
## maileclipse/templates/new
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/maileclipse/templates/new" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/templates/new"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST maileclipse/templates/new`


<!-- END_63d50d240d07520e0fe7cb50bb8194ff -->

<!-- START_e00dd154abbc405ef473a754ebd7a54e -->
## maileclipse/templates/delete
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/maileclipse/templates/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/templates/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST maileclipse/templates/delete`


<!-- END_e00dd154abbc405ef473a754ebd7a54e -->

<!-- START_45472a32eb082435e22242163a3db3ae -->
## maileclipse/templates/update
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/maileclipse/templates/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/templates/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST maileclipse/templates/update`


<!-- END_45472a32eb082435e22242163a3db3ae -->

<!-- START_cd8c0e08626c33a570cfa12fb1d3c8bb -->
## maileclipse/templates/preview
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/maileclipse/templates/preview" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/templates/preview"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST maileclipse/templates/preview`


<!-- END_cd8c0e08626c33a570cfa12fb1d3c8bb -->

<!-- START_dee64fd721b73c4b86d247d9244d54ac -->
## maileclipse/mailables
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/maileclipse/mailables" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/mailables"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET maileclipse/mailables`


<!-- END_dee64fd721b73c4b86d247d9244d54ac -->

<!-- START_2204d734cc001126874f07b741065359 -->
## maileclipse/mailables/view/{name}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/maileclipse/mailables/view/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/mailables/view/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET maileclipse/mailables/view/{name}`


<!-- END_2204d734cc001126874f07b741065359 -->

<!-- START_7776f0eef669b202d8518bee01fda62a -->
## maileclipse/mailables/edit/template/{name}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/maileclipse/mailables/edit/template/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/mailables/edit/template/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET maileclipse/mailables/edit/template/{name}`


<!-- END_7776f0eef669b202d8518bee01fda62a -->

<!-- START_2bac818e3ddf365d490891984c0c626c -->
## maileclipse/mailables/parse/template
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/maileclipse/mailables/parse/template" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/mailables/parse/template"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST maileclipse/mailables/parse/template`


<!-- END_2bac818e3ddf365d490891984c0c626c -->

<!-- START_6f313a32e78af8eb2bc87da264e66739 -->
## maileclipse/mailables/preview/template
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/maileclipse/mailables/preview/template" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/mailables/preview/template"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST maileclipse/mailables/preview/template`


<!-- END_6f313a32e78af8eb2bc87da264e66739 -->

<!-- START_511e7811236db3efdb4ff7ddf6a62a80 -->
## maileclipse/mailables/preview/template/previewerror
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/maileclipse/mailables/preview/template/previewerror" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/mailables/preview/template/previewerror"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET maileclipse/mailables/preview/template/previewerror`


<!-- END_511e7811236db3efdb4ff7ddf6a62a80 -->

<!-- START_8bafde02b975658717f6e6f3e739de90 -->
## maileclipse/mailables/preview/{name}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/maileclipse/mailables/preview/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/mailables/preview/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET maileclipse/mailables/preview/{name}`


<!-- END_8bafde02b975658717f6e6f3e739de90 -->

<!-- START_feaf3aa68a3f1c4d7c97d5b94355f184 -->
## maileclipse/mailables/new
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/maileclipse/mailables/new" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/mailables/new"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET maileclipse/mailables/new`


<!-- END_feaf3aa68a3f1c4d7c97d5b94355f184 -->

<!-- START_cf8900156df26c54a307ffea404a6605 -->
## maileclipse/mailables/new
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/maileclipse/mailables/new" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/mailables/new"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST maileclipse/mailables/new`


<!-- END_cf8900156df26c54a307ffea404a6605 -->

<!-- START_044e3eb231975fec257136ef13cf6040 -->
## maileclipse/mailables/delete
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/maileclipse/mailables/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/maileclipse/mailables/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST maileclipse/mailables/delete`


<!-- END_044e3eb231975fec257136ef13cf6040 -->

<!-- START_81f1855bde71c68a304ad17cd454d253 -->
## tenancy/assets/{path?}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/tenancy/assets/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/tenancy/assets/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET tenancy/assets/{path?}`


<!-- END_81f1855bde71c68a304ad17cd454d253 -->

<!-- START_66e08d3cc8222573018fed49e121e96d -->
## Show the application&#039;s login form.

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET login`


<!-- END_66e08d3cc8222573018fed49e121e96d -->

<!-- START_ba35aa39474cb98cfb31829e70eb8b74 -->
## login
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST login`


<!-- END_ba35aa39474cb98cfb31829e70eb8b74 -->

<!-- START_e65925f23b9bc6b93d9356895f29f80c -->
## Log the user out of the application.

> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST logout`


<!-- END_e65925f23b9bc6b93d9356895f29f80c -->

<!-- START_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->
## Show the application registration form.

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET register`


<!-- END_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->

<!-- START_d7aad7b5ac127700500280d511a3db01 -->
## Handle a registration request for the application.

> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST register`


<!-- END_d7aad7b5ac127700500280d511a3db01 -->

<!-- START_d72797bae6d0b1f3a341ebb1f8900441 -->
## Display the form to request a password reset link.

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET password/reset`


<!-- END_d72797bae6d0b1f3a341ebb1f8900441 -->

<!-- START_feb40f06a93c80d742181b6ffb6b734e -->
## Send a reset link to the given user.

> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/password/email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/password/email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/email`


<!-- END_feb40f06a93c80d742181b6ffb6b734e -->

<!-- START_e1605a6e5ceee9d1aeb7729216635fd7 -->
## Display the password reset view for the given token.

If no token is present, display the link request form.

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/password/reset/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/password/reset/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET password/reset/{token}`


<!-- END_e1605a6e5ceee9d1aeb7729216635fd7 -->

<!-- START_cafb407b7a846b31491f97719bb15aef -->
## Reset the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/reset`


<!-- END_cafb407b7a846b31491f97719bb15aef -->

<!-- START_b77aedc454e9471a35dcb175278ec997 -->
## Display the password confirmation view.

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET password/confirm`


<!-- END_b77aedc454e9471a35dcb175278ec997 -->

<!-- START_54462d3613f2262e741142161c0e6fea -->
## Confirm the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/confirm`


<!-- END_54462d3613f2262e741142161c0e6fea -->

<!-- START_66e08d3cc8222573018fed49e121e96d -->
## Show the application&#039;s login form.

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET login`


<!-- END_66e08d3cc8222573018fed49e121e96d -->

<!-- START_ba35aa39474cb98cfb31829e70eb8b74 -->
## login
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST login`


<!-- END_ba35aa39474cb98cfb31829e70eb8b74 -->

<!-- START_e65925f23b9bc6b93d9356895f29f80c -->
## Log the user out of the application.

> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST logout`


<!-- END_e65925f23b9bc6b93d9356895f29f80c -->

<!-- START_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->
## Show the application registration form.

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET register`


<!-- END_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->

<!-- START_d7aad7b5ac127700500280d511a3db01 -->
## Handle a registration request for the application.

> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST register`


<!-- END_d7aad7b5ac127700500280d511a3db01 -->

<!-- START_d72797bae6d0b1f3a341ebb1f8900441 -->
## Display the form to request a password reset link.

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET password/reset`


<!-- END_d72797bae6d0b1f3a341ebb1f8900441 -->

<!-- START_feb40f06a93c80d742181b6ffb6b734e -->
## Send a reset link to the given user.

> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/password/email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/password/email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/email`


<!-- END_feb40f06a93c80d742181b6ffb6b734e -->

<!-- START_e1605a6e5ceee9d1aeb7729216635fd7 -->
## Display the password reset view for the given token.

If no token is present, display the link request form.

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/password/reset/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/password/reset/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET password/reset/{token}`


<!-- END_e1605a6e5ceee9d1aeb7729216635fd7 -->

<!-- START_cafb407b7a846b31491f97719bb15aef -->
## Reset the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/reset`


<!-- END_cafb407b7a846b31491f97719bb15aef -->

<!-- START_b77aedc454e9471a35dcb175278ec997 -->
## Display the password confirmation view.

> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET password/confirm`


<!-- END_b77aedc454e9471a35dcb175278ec997 -->

<!-- START_54462d3613f2262e741142161c0e6fea -->
## Confirm the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/confirm`


<!-- END_54462d3613f2262e741142161c0e6fea -->

<!-- START_2534e8474f687fe3cf8e4b7f63532ad8 -->
## SuperAdmin/dashboard
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/SuperAdmin/dashboard" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/dashboard"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET SuperAdmin/dashboard`


<!-- END_2534e8474f687fe3cf8e4b7f63532ad8 -->

<!-- START_17eaf4e22b80b4b4cd74cb358011f837 -->
## SuperAdmin/ManageEmployees
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/SuperAdmin/ManageEmployees" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/ManageEmployees"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET SuperAdmin/ManageEmployees`


<!-- END_17eaf4e22b80b4b4cd74cb358011f837 -->

<!-- START_3c3b771a781d3ca15518c0820ab17f40 -->
## SuperAdmin/AddEmployee
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/SuperAdmin/AddEmployee" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/AddEmployee"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET SuperAdmin/AddEmployee`


<!-- END_3c3b771a781d3ca15518c0820ab17f40 -->

<!-- START_54e460c8f169ebf722d5cf3a4c017462 -->
## SuperAdmin/StoreNewEmployee
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/SuperAdmin/StoreNewEmployee" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/StoreNewEmployee"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST SuperAdmin/StoreNewEmployee`


<!-- END_54e460c8f169ebf722d5cf3a4c017462 -->

<!-- START_957f95b0a6a789429bf67bcd2d99c368 -->
## SuperAdmin/EditEmployee/{employee}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/SuperAdmin/EditEmployee/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/EditEmployee/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET SuperAdmin/EditEmployee/{employee}`


<!-- END_957f95b0a6a789429bf67bcd2d99c368 -->

<!-- START_c0097fb938a7c5656260095e235e023b -->
## SuperAdmin/UpdateEmployee/{employee}
> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/SuperAdmin/UpdateEmployee/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/UpdateEmployee/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH SuperAdmin/UpdateEmployee/{employee}`


<!-- END_c0097fb938a7c5656260095e235e023b -->

<!-- START_3240fcd744fe9e64ba129c48446c4573 -->
## SuperAdmin/DeleteEmployee/{employee}
> Example request:

```bash
curl -X DELETE \
    "auditingWithTenancy/SuperAdmin/DeleteEmployee/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/DeleteEmployee/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE SuperAdmin/DeleteEmployee/{employee}`


<!-- END_3240fcd744fe9e64ba129c48446c4573 -->

<!-- START_d7a0b83ad67cb087b49dc063f40173b8 -->
## SuperAdmin/ManageDropDowns
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/SuperAdmin/ManageDropDowns" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/ManageDropDowns"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET SuperAdmin/ManageDropDowns`


<!-- END_d7a0b83ad67cb087b49dc063f40173b8 -->

<!-- START_5b6007c4cf6751367584794a865fc1d9 -->
## SuperAdmin/StoreDropDownsOption
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/SuperAdmin/StoreDropDownsOption" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/StoreDropDownsOption"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST SuperAdmin/StoreDropDownsOption`


<!-- END_5b6007c4cf6751367584794a865fc1d9 -->

<!-- START_0e2d2e805b7bde137d94456fdc5f8124 -->
## SuperAdmin/DeleteDropDownsOption/{id}
> Example request:

```bash
curl -X DELETE \
    "auditingWithTenancy/SuperAdmin/DeleteDropDownsOption/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/DeleteDropDownsOption/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE SuperAdmin/DeleteDropDownsOption/{id}`


<!-- END_0e2d2e805b7bde137d94456fdc5f8124 -->

<!-- START_7cf1f4fa64f8e850b6727cc0abbc324d -->
## SuperAdmin/UpdateDropDownsOption/{id}
> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/SuperAdmin/UpdateDropDownsOption/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/UpdateDropDownsOption/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH SuperAdmin/UpdateDropDownsOption/{id}`


<!-- END_7cf1f4fa64f8e850b6727cc0abbc324d -->

<!-- START_05634d0b48e2852d39d4fbdbaa35aa20 -->
## SuperAdmin/AccountCharts
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/SuperAdmin/AccountCharts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/AccountCharts"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET SuperAdmin/AccountCharts`


<!-- END_05634d0b48e2852d39d4fbdbaa35aa20 -->

<!-- START_b9c4e42ef6b75a561c5c392bfeb76041 -->
## SuperAdmin/StoreAccountChart
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/SuperAdmin/StoreAccountChart" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/StoreAccountChart"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST SuperAdmin/StoreAccountChart`


<!-- END_b9c4e42ef6b75a561c5c392bfeb76041 -->

<!-- START_f1ce26e8ea680eb7f6fcbefcbae1df42 -->
## SuperAdmin/DeleteAccountChart/{id}/level/{level}
> Example request:

```bash
curl -X DELETE \
    "auditingWithTenancy/SuperAdmin/DeleteAccountChart/1/level/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/DeleteAccountChart/1/level/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE SuperAdmin/DeleteAccountChart/{id}/level/{level}`


<!-- END_f1ce26e8ea680eb7f6fcbefcbae1df42 -->

<!-- START_9a1ffa42b9a03f378f3be326869b3121 -->
## SuperAdmin/UpdateAccountChart
> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/SuperAdmin/UpdateAccountChart" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/UpdateAccountChart"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH SuperAdmin/UpdateAccountChart`


<!-- END_9a1ffa42b9a03f378f3be326869b3121 -->

<!-- START_8dddea86e904cd3fb183244209e241a7 -->
## SuperAdmin/ManageRevisingGuid
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/SuperAdmin/ManageRevisingGuid" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/ManageRevisingGuid"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET SuperAdmin/ManageRevisingGuid`


<!-- END_8dddea86e904cd3fb183244209e241a7 -->

<!-- START_558de8f648dce0a7bb492d6153f9e732 -->
## SuperAdmin/UpdateRevisingGuid/{RevisingGuidID}
> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/SuperAdmin/UpdateRevisingGuid/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/UpdateRevisingGuid/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH SuperAdmin/UpdateRevisingGuid/{RevisingGuidID}`


<!-- END_558de8f648dce0a7bb492d6153f9e732 -->

<!-- START_ca35e487dc82a70a3cfede50b41a0299 -->
## SuperAdmin/StoreNewRevisingGuid
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/SuperAdmin/StoreNewRevisingGuid" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/StoreNewRevisingGuid"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST SuperAdmin/StoreNewRevisingGuid`


<!-- END_ca35e487dc82a70a3cfede50b41a0299 -->

<!-- START_7ee5490300c53870684fc87f45c160fd -->
## SuperAdmin/DeleteRevisingGuid/{RevisingGuidID}
> Example request:

```bash
curl -X DELETE \
    "auditingWithTenancy/SuperAdmin/DeleteRevisingGuid/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/DeleteRevisingGuid/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE SuperAdmin/DeleteRevisingGuid/{RevisingGuidID}`


<!-- END_7ee5490300c53870684fc87f45c160fd -->

<!-- START_f9400f7c499d682f68ffe1f1d29e0c38 -->
## SuperAdmin/ManageFinancialGroups
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/SuperAdmin/ManageFinancialGroups" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/ManageFinancialGroups"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET SuperAdmin/ManageFinancialGroups`


<!-- END_f9400f7c499d682f68ffe1f1d29e0c38 -->

<!-- START_7426112565bf00a27d9cb34c8db5b19c -->
## SuperAdmin/UpdateFinancialGroup//{FinancialGroupID}
> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/SuperAdmin/UpdateFinancialGroup//1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/UpdateFinancialGroup//1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH SuperAdmin/UpdateFinancialGroup//{FinancialGroupID}`


<!-- END_7426112565bf00a27d9cb34c8db5b19c -->

<!-- START_b668ee38789e6d9b574330034ea5e561 -->
## SuperAdmin/StoreNewFinancialGroup
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/SuperAdmin/StoreNewFinancialGroup" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/StoreNewFinancialGroup"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST SuperAdmin/StoreNewFinancialGroup`


<!-- END_b668ee38789e6d9b574330034ea5e561 -->

<!-- START_83ce37231d52d2ee7414d62f3638ac2d -->
## SuperAdmin/DeleteFinancialGroup/{FinancialGroupID}
> Example request:

```bash
curl -X DELETE \
    "auditingWithTenancy/SuperAdmin/DeleteFinancialGroup/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/DeleteFinancialGroup/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE SuperAdmin/DeleteFinancialGroup/{FinancialGroupID}`


<!-- END_83ce37231d52d2ee7414d62f3638ac2d -->

<!-- START_ca99930a3979a577742667c87778bfdf -->
## SuperAdmin/LinkAccountToFinancialGroup/{FinancialGroupID}
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/SuperAdmin/LinkAccountToFinancialGroup/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/LinkAccountToFinancialGroup/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST SuperAdmin/LinkAccountToFinancialGroup/{FinancialGroupID}`


<!-- END_ca99930a3979a577742667c87778bfdf -->

<!-- START_9a5f1ddb9c939ad80003631e43ec2915 -->
## SuperAdmin/UnLinkAccountFromFinancialGroup/{AccountID}
> Example request:

```bash
curl -X DELETE \
    "auditingWithTenancy/SuperAdmin/UnLinkAccountFromFinancialGroup/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/SuperAdmin/UnLinkAccountFromFinancialGroup/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE SuperAdmin/UnLinkAccountFromFinancialGroup/{AccountID}`


<!-- END_9a5f1ddb9c939ad80003631e43ec2915 -->

<!-- START_6d277522f7ffa5cb792224b642ab5c58 -->
## Secretary/Transactions
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/Secretary/Transactions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Secretary/Transactions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET Secretary/Transactions`


<!-- END_6d277522f7ffa5cb792224b642ab5c58 -->

<!-- START_d732a768110d6845a77f40f1bdab652b -->
## Secretary/CreateTransaction
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/Secretary/CreateTransaction" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Secretary/CreateTransaction"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET Secretary/CreateTransaction`


<!-- END_d732a768110d6845a77f40f1bdab652b -->

<!-- START_a1947c3bee1d91922c6982e912d6b726 -->
## Secretary/StoreNewTransaction/institution/{institution}/reviser/{reviser}
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/Secretary/StoreNewTransaction/institution/1/reviser/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Secretary/StoreNewTransaction/institution/1/reviser/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST Secretary/StoreNewTransaction/institution/{institution}/reviser/{reviser}`


<!-- END_a1947c3bee1d91922c6982e912d6b726 -->

<!-- START_e854c86341294e905847a916d97e7789 -->
## Secretary/PrintReceiptVoucher/TransactionYear/{TransactionYear}/CompanyName/{CompanyName}/PaymentType/{PaymentType}/PaymentValue/{PaymentValue}/ReviserCompanyName/{ReviserCompanyName}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/Secretary/PrintReceiptVoucher/TransactionYear/1/CompanyName/1/PaymentType/1/PaymentValue/1/ReviserCompanyName/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Secretary/PrintReceiptVoucher/TransactionYear/1/CompanyName/1/PaymentType/1/PaymentValue/1/ReviserCompanyName/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET Secretary/PrintReceiptVoucher/TransactionYear/{TransactionYear}/CompanyName/{CompanyName}/PaymentType/{PaymentType}/PaymentValue/{PaymentValue}/ReviserCompanyName/{ReviserCompanyName}`


<!-- END_e854c86341294e905847a916d97e7789 -->

<!-- START_9b72df565d7dfd9197882b71bf5f32c7 -->
## Secretary/EngagementLetter/institution/{institution}/transaction/{transaction}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/Secretary/EngagementLetter/institution/1/transaction/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Secretary/EngagementLetter/institution/1/transaction/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET Secretary/EngagementLetter/institution/{institution}/transaction/{transaction}`


<!-- END_9b72df565d7dfd9197882b71bf5f32c7 -->

<!-- START_d4c414cb492ea47627539046a81d3e97 -->
## Secretary/EditTransaction/{Transaction_id}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/Secretary/EditTransaction/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Secretary/EditTransaction/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET Secretary/EditTransaction/{Transaction_id}`


<!-- END_d4c414cb492ea47627539046a81d3e97 -->

<!-- START_45dd1b2f537f7ac326d9a84ab6a08555 -->
## Secretary/StoreNewInstitution
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/Secretary/StoreNewInstitution" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Secretary/StoreNewInstitution"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST Secretary/StoreNewInstitution`


<!-- END_45dd1b2f537f7ac326d9a84ab6a08555 -->

<!-- START_4daeeda415a6504e92c1a6514a62a0d8 -->
## Secretary/UpdateInstitution/{institution}
> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/Secretary/UpdateInstitution/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Secretary/UpdateInstitution/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH Secretary/UpdateInstitution/{institution}`


<!-- END_4daeeda415a6504e92c1a6514a62a0d8 -->

<!-- START_7267b045912d0f2e675296ec40be6bdf -->
## Secretary/StoreNewAgentFor/{institution}
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/Secretary/StoreNewAgentFor/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Secretary/StoreNewAgentFor/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST Secretary/StoreNewAgentFor/{institution}`


<!-- END_7267b045912d0f2e675296ec40be6bdf -->

<!-- START_7922de068d71ea1a923540ec441c028b -->
## Secretary/UpdateAgent/{agent}
> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/Secretary/UpdateAgent/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Secretary/UpdateAgent/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH Secretary/UpdateAgent/{agent}`


<!-- END_7922de068d71ea1a923540ec441c028b -->

<!-- START_00e24f653d353a5441fbc3bfd774fc72 -->
## Secretary/SearchNewRegister
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/Secretary/SearchNewRegister" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Secretary/SearchNewRegister"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST Secretary/SearchNewRegister`


<!-- END_00e24f653d353a5441fbc3bfd774fc72 -->

<!-- START_44b6e6dbda01736ce1daa12b16429e11 -->
## Secretary/StoreNewRegisterTrade/{institution}
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/Secretary/StoreNewRegisterTrade/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Secretary/StoreNewRegisterTrade/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST Secretary/StoreNewRegisterTrade/{institution}`


<!-- END_44b6e6dbda01736ce1daa12b16429e11 -->

<!-- START_9fed0bbc175e8d46a11423e7c690e3c4 -->
## Secretary/UpdateRegister/{TradeRegister}
> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/Secretary/UpdateRegister/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Secretary/UpdateRegister/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH Secretary/UpdateRegister/{TradeRegister}`


<!-- END_9fed0bbc175e8d46a11423e7c690e3c4 -->

<!-- START_cac92d4e6a05e8e9abf51173e434ad54 -->
## Secretary/DeleteTradeRegister/{TradeRegisterID}
> Example request:

```bash
curl -X DELETE \
    "auditingWithTenancy/Secretary/DeleteTradeRegister/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Secretary/DeleteTradeRegister/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE Secretary/DeleteTradeRegister/{TradeRegisterID}`


<!-- END_cac92d4e6a05e8e9abf51173e434ad54 -->

<!-- START_55dbd816f1bc022603fcafce5b09043c -->
## Reviser/Transactions
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/Reviser/Transactions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Reviser/Transactions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET Reviser/Transactions`


<!-- END_55dbd816f1bc022603fcafce5b09043c -->

<!-- START_1fb718b37a400eab192f2ec08a3e1386 -->
## Reviser/EditTransaction/{Transaction_id}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/Reviser/EditTransaction/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Reviser/EditTransaction/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET Reviser/EditTransaction/{Transaction_id}`


<!-- END_1fb718b37a400eab192f2ec08a3e1386 -->

<!-- START_364c699b097e22a56928b3a479bdefa2 -->
## TechnicalAuditor/Transactions
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/TechnicalAuditor/Transactions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/TechnicalAuditor/Transactions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET TechnicalAuditor/Transactions`


<!-- END_364c699b097e22a56928b3a479bdefa2 -->

<!-- START_b07a64e5465844402dd36d538ccea707 -->
## TechnicalAuditor/EditTransaction/{Transaction_id}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/TechnicalAuditor/EditTransaction/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/TechnicalAuditor/EditTransaction/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET TechnicalAuditor/EditTransaction/{Transaction_id}`


<!-- END_b07a64e5465844402dd36d538ccea707 -->

<!-- START_c09a45cdf2997a5b3320db710a34dc2e -->
## TechnicalAuditor/AccountAvailableForExcelLinking/{TransactionID}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/TechnicalAuditor/AccountAvailableForExcelLinking/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/TechnicalAuditor/AccountAvailableForExcelLinking/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET TechnicalAuditor/AccountAvailableForExcelLinking/{TransactionID}`


<!-- END_c09a45cdf2997a5b3320db710a34dc2e -->

<!-- START_7de04b9912a4b03bcbb443e7af56bc5b -->
## TechnicalAuditor/GetUploadedAccountsExcelHeaders
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/TechnicalAuditor/GetUploadedAccountsExcelHeaders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/TechnicalAuditor/GetUploadedAccountsExcelHeaders"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST TechnicalAuditor/GetUploadedAccountsExcelHeaders`


<!-- END_7de04b9912a4b03bcbb443e7af56bc5b -->

<!-- START_522eacc7c00d35e27189f74950e3b1d5 -->
## TechnicalAuditor/StoreNewBranchedStatementAddedByExcel
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/TechnicalAuditor/StoreNewBranchedStatementAddedByExcel" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/TechnicalAuditor/StoreNewBranchedStatementAddedByExcel"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST TechnicalAuditor/StoreNewBranchedStatementAddedByExcel`


<!-- END_522eacc7c00d35e27189f74950e3b1d5 -->

<!-- START_538e31a3d0273ad292bde42b6d59e2d0 -->
## TechnicalAuditor/DeleteExistingBranchedStatementAddedByExcel/{BranchedStatementID}/WhoseParent/{ParentID}
> Example request:

```bash
curl -X DELETE \
    "auditingWithTenancy/TechnicalAuditor/DeleteExistingBranchedStatementAddedByExcel/1/WhoseParent/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/TechnicalAuditor/DeleteExistingBranchedStatementAddedByExcel/1/WhoseParent/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE TechnicalAuditor/DeleteExistingBranchedStatementAddedByExcel/{BranchedStatementID}/WhoseParent/{ParentID}`


<!-- END_538e31a3d0273ad292bde42b6d59e2d0 -->

<!-- START_1fec506264869d28d11347ff9e4741ae -->
## AllTransactions/{OrderByCase?}/{MainRegisterNumber?}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/AllTransactions//" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/AllTransactions//"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET AllTransactions/{OrderByCase?}/{MainRegisterNumber?}`


<!-- END_1fec506264869d28d11347ff9e4741ae -->

<!-- START_0b596fe756ab3db6b27156ba5bf0e58d -->
## ManagementPartner/Transactions
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/ManagementPartner/Transactions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/ManagementPartner/Transactions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET ManagementPartner/Transactions`


<!-- END_0b596fe756ab3db6b27156ba5bf0e58d -->

<!-- START_6ecd326c9c37802ad1941fff40eb4156 -->
## ManagementPartner/EditTransaction/{Transaction_id}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/ManagementPartner/EditTransaction/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/ManagementPartner/EditTransaction/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET ManagementPartner/EditTransaction/{Transaction_id}`


<!-- END_6ecd326c9c37802ad1941fff40eb4156 -->

<!-- START_20920e820503149f865ecbdf5bb590f4 -->
## RevisingManager/dashboard
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/RevisingManager/dashboard" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/RevisingManager/dashboard"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET RevisingManager/dashboard`


<!-- END_20920e820503149f865ecbdf5bb590f4 -->

<!-- START_5569e6a7379a2531cc31c7dd050cbea5 -->
## RevisingManager/Transactions
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/RevisingManager/Transactions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/RevisingManager/Transactions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET RevisingManager/Transactions`


<!-- END_5569e6a7379a2531cc31c7dd050cbea5 -->

<!-- START_9ea264c602c87d48a179126313b11fba -->
## RevisingManager/EditTransaction/{Transaction_id}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/RevisingManager/EditTransaction/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/RevisingManager/EditTransaction/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET RevisingManager/EditTransaction/{Transaction_id}`


<!-- END_9ea264c602c87d48a179126313b11fba -->

<!-- START_2d06c5c20cf8972e518a63e9e061531c -->
## ArchiveSecretary/Transactions
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/ArchiveSecretary/Transactions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/ArchiveSecretary/Transactions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET ArchiveSecretary/Transactions`


<!-- END_2d06c5c20cf8972e518a63e9e061531c -->

<!-- START_d5665895acd9a1cacd85e3afbc8eebb4 -->
## ArchiveSecretary/RevisingGuid/Transaction/{TransactionsID}/{WithRelation?}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/ArchiveSecretary/RevisingGuid/Transaction/1/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/ArchiveSecretary/RevisingGuid/Transaction/1/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET ArchiveSecretary/RevisingGuid/Transaction/{TransactionsID}/{WithRelation?}`


<!-- END_d5665895acd9a1cacd85e3afbc8eebb4 -->

<!-- START_bc4596e98655a9bfd23f7a8d65deb40b -->
## ArchiveSecretary/RevisingGuidList/{transactionID}/Guide/{RevisingGuidID}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/ArchiveSecretary/RevisingGuidList/1/Guide/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/ArchiveSecretary/RevisingGuidList/1/Guide/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET ArchiveSecretary/RevisingGuidList/{transactionID}/Guide/{RevisingGuidID}`


<!-- END_bc4596e98655a9bfd23f7a8d65deb40b -->

<!-- START_5dec26b13b5dea8f855ddec159cc0757 -->
## ArchiveSecretary/UpdateArchiveRecord/{transactionID}
> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/ArchiveSecretary/UpdateArchiveRecord/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/ArchiveSecretary/UpdateArchiveRecord/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH ArchiveSecretary/UpdateArchiveRecord/{transactionID}`


<!-- END_5dec26b13b5dea8f855ddec159cc0757 -->

<!-- START_f81d5c0d40ee19472008d07c78311814 -->
## ArchiveSecretary/StoreArchiveRecord/{transactionID}
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/ArchiveSecretary/StoreArchiveRecord/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/ArchiveSecretary/StoreArchiveRecord/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST ArchiveSecretary/StoreArchiveRecord/{transactionID}`


<!-- END_f81d5c0d40ee19472008d07c78311814 -->

<!-- START_5799883540e324eb5f2e9e0eb487b491 -->
## OfficeInfo
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/OfficeInfo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/OfficeInfo"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET OfficeInfo`


<!-- END_5799883540e324eb5f2e9e0eb487b491 -->

<!-- START_5dffa5d874d356dee215df0955901ccc -->
## StoreOfficeInfo
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/StoreOfficeInfo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/StoreOfficeInfo"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST StoreOfficeInfo`


<!-- END_5dffa5d874d356dee215df0955901ccc -->

<!-- START_eebc5b04e305f81371d22f8755dafbe8 -->
## UpdateOfficeInfo
> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/UpdateOfficeInfo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/UpdateOfficeInfo"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH UpdateOfficeInfo`


<!-- END_eebc5b04e305f81371d22f8755dafbe8 -->

<!-- START_94e0e7bd8c2a61f640dd7a56dcd1266d -->
## UpdateTransaction/{transaction}
> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/UpdateTransaction/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/UpdateTransaction/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH UpdateTransaction/{transaction}`


<!-- END_94e0e7bd8c2a61f640dd7a56dcd1266d -->

<!-- START_7f2c0c93ca4ba4540be584ff4e324329 -->
## UpdateTransactionActualTime/{transaction}
> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/UpdateTransactionActualTime/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/UpdateTransactionActualTime/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH UpdateTransactionActualTime/{transaction}`


<!-- END_7f2c0c93ca4ba4540be584ff4e324329 -->

<!-- START_388895b6c6e11957e4ab353fce76fc68 -->
## Documents/{transactionID?}/document/{documentCode?}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/Documents//document/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/Documents//document/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET Documents/{transactionID?}/document/{documentCode?}`


<!-- END_388895b6c6e11957e4ab353fce76fc68 -->

<!-- START_a975f31fd2314cf0039cc959f24555da -->
## AddTransactionDocumentFor/{Transaction}/document/{document}
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/AddTransactionDocumentFor/1/document/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/AddTransactionDocumentFor/1/document/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST AddTransactionDocumentFor/{Transaction}/document/{document}`


<!-- END_a975f31fd2314cf0039cc959f24555da -->

<!-- START_2dc25b239b37bd4adbfa0e4b79ecb1cb -->
## RemoveTransactionDocument/{documentID}
> Example request:

```bash
curl -X DELETE \
    "auditingWithTenancy/RemoveTransactionDocument/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/RemoveTransactionDocument/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE RemoveTransactionDocument/{documentID}`


<!-- END_2dc25b239b37bd4adbfa0e4b79ecb1cb -->

<!-- START_1d1c334e2c56bfd93a2986c3c5adfa67 -->
## DownloadDocuments/{documentPath}/name/{documentName}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/DownloadDocuments/1/name/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/DownloadDocuments/1/name/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET DownloadDocuments/{documentPath}/name/{documentName}`


<!-- END_1d1c334e2c56bfd93a2986c3c5adfa67 -->

<!-- START_4c361e7942ca643a1235a2b1944610d5 -->
## AddDocumentComment
> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/AddDocumentComment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/AddDocumentComment"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH AddDocumentComment`


<!-- END_4c361e7942ca643a1235a2b1944610d5 -->

<!-- START_05297f634950a05fe1a783be045ad776 -->
## GetDropDownsOptions
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/GetDropDownsOptions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/GetDropDownsOptions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET GetDropDownsOptions`


<!-- END_05297f634950a05fe1a783be045ad776 -->

<!-- START_c9977da86355d0ef913c0bebc35b015c -->
## GetEmployeesType/{employees_type}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/GetEmployeesType/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/GetEmployeesType/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET GetEmployeesType/{employees_type}`


<!-- END_c9977da86355d0ef913c0bebc35b015c -->

<!-- START_4df1abfe9cf9444a9e01d02441d71ad7 -->
## AllAccountCharts
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/AllAccountCharts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/AllAccountCharts"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET AllAccountCharts`


<!-- END_4df1abfe9cf9444a9e01d02441d71ad7 -->

<!-- START_da87a9d1f1b5cc9f41ec8e85b1bc82f7 -->
## NestedAccountCharts
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/NestedAccountCharts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/NestedAccountCharts"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET NestedAccountCharts`


<!-- END_da87a9d1f1b5cc9f41ec8e85b1bc82f7 -->

<!-- START_486007e4d98acf575ffdf2d762a04ee6 -->
## AllTransactionAccountsTreeWithStatements/{TransactionID}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/AllTransactionAccountsTreeWithStatements/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/AllTransactionAccountsTreeWithStatements/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET AllTransactionAccountsTreeWithStatements/{TransactionID}`


<!-- END_486007e4d98acf575ffdf2d762a04ee6 -->

<!-- START_898768e134b556ed2dc72f5112c601dd -->
## TransactionAccountStatements/{TransactionID}/account/{AccountID}/level/{AccountLevel}/WithoutReadOnlyData/{WithoutReadOnly?}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/TransactionAccountStatements/1/account/1/level/1/WithoutReadOnlyData/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/TransactionAccountStatements/1/account/1/level/1/WithoutReadOnlyData/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET TransactionAccountStatements/{TransactionID}/account/{AccountID}/level/{AccountLevel}/WithoutReadOnlyData/{WithoutReadOnly?}`


<!-- END_898768e134b556ed2dc72f5112c601dd -->

<!-- START_62b6f39199f798f877d887188c31c465 -->
## TransactionAccountsWithSumOfStatements/{TransactionID}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/TransactionAccountsWithSumOfStatements/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/TransactionAccountsWithSumOfStatements/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET TransactionAccountsWithSumOfStatements/{TransactionID}`


<!-- END_62b6f39199f798f877d887188c31c465 -->

<!-- START_f58381b562c42b0a6f73b05458d2856f -->
## StoreNewTransactionAccountStatement/{transactionID}
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/StoreNewTransactionAccountStatement/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/StoreNewTransactionAccountStatement/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST StoreNewTransactionAccountStatement/{transactionID}`


<!-- END_f58381b562c42b0a6f73b05458d2856f -->

<!-- START_ac2648023f885634bd12bfb650aa81a3 -->
## DeleteTransactionAccountStatements/{StatementID}
> Example request:

```bash
curl -X DELETE \
    "auditingWithTenancy/DeleteTransactionAccountStatements/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/DeleteTransactionAccountStatements/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE DeleteTransactionAccountStatements/{StatementID}`


<!-- END_ac2648023f885634bd12bfb650aa81a3 -->

<!-- START_d39e2d5842c5cf1e4369bebe6d6d2be8 -->
## UpdateTransactionAccountStatement/{StatementID}
> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/UpdateTransactionAccountStatement/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/UpdateTransactionAccountStatement/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH UpdateTransactionAccountStatement/{StatementID}`


<!-- END_d39e2d5842c5cf1e4369bebe6d6d2be8 -->

<!-- START_f41db3195b72335e29d78e8008195597 -->
## TransactionAccountStatementsWithBranches/{TransactionID}/account/{AccountID}/level/{AccountLevel}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/TransactionAccountStatementsWithBranches/1/account/1/level/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/TransactionAccountStatementsWithBranches/1/account/1/level/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET TransactionAccountStatementsWithBranches/{TransactionID}/account/{AccountID}/level/{AccountLevel}`


<!-- END_f41db3195b72335e29d78e8008195597 -->

<!-- START_b8d236d6e42491c75248638b5267362c -->
## StatementReadOnlyDataForAccount/{TransactionID}/account/{Account_id}/Level/{AccountLevel}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/StatementReadOnlyDataForAccount/1/account/1/Level/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/StatementReadOnlyDataForAccount/1/account/1/Level/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET StatementReadOnlyDataForAccount/{TransactionID}/account/{Account_id}/Level/{AccountLevel}`


<!-- END_b8d236d6e42491c75248638b5267362c -->

<!-- START_4e206147115b128fdf4c4a1cda876760 -->
## AccountStatementBranches/{StatementID}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/AccountStatementBranches/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/AccountStatementBranches/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET AccountStatementBranches/{StatementID}`


<!-- END_4e206147115b128fdf4c4a1cda876760 -->

<!-- START_8689f94a2b8b351a453efb198fd12072 -->
## UpdateBranchOfAccountStatement/{BranchedStatementID}
> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/UpdateBranchOfAccountStatement/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/UpdateBranchOfAccountStatement/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH UpdateBranchOfAccountStatement/{BranchedStatementID}`


<!-- END_8689f94a2b8b351a453efb198fd12072 -->

<!-- START_03e5f4fe9f59e9120e97ccc7ecd281d9 -->
## StoreNewBranchedStatement
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/StoreNewBranchedStatement" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/StoreNewBranchedStatement"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST StoreNewBranchedStatement`


<!-- END_03e5f4fe9f59e9120e97ccc7ecd281d9 -->

<!-- START_b9e4617c543fd548a96592e6719bb8ad -->
## AccountsHasInKind/{TransactionID}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/AccountsHasInKind/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/AccountsHasInKind/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET AccountsHasInKind/{TransactionID}`


<!-- END_b9e4617c543fd548a96592e6719bb8ad -->

<!-- START_5a6fa771c8596376f973d85390c0d011 -->
## InKind/{AccountStatementID}
> Example request:

```bash
curl -X GET \
    -G "auditingWithTenancy/InKind/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/InKind/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET InKind/{AccountStatementID}`


<!-- END_5a6fa771c8596376f973d85390c0d011 -->

<!-- START_c47db7513d9737ee47e99d7f5547c822 -->
## StoreNewInKind
> Example request:

```bash
curl -X POST \
    "auditingWithTenancy/StoreNewInKind" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/StoreNewInKind"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST StoreNewInKind`


<!-- END_c47db7513d9737ee47e99d7f5547c822 -->

<!-- START_5122dc0171d0a43ed07d8abef391aff0 -->
## UpdateInKind/{InKindID}
> Example request:

```bash
curl -X PATCH \
    "auditingWithTenancy/UpdateInKind/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/UpdateInKind/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH UpdateInKind/{InKindID}`


<!-- END_5122dc0171d0a43ed07d8abef391aff0 -->

<!-- START_46309309c50828ed0e5df95c0e2bcbe9 -->
## DeleteInKind/{InKindID}/Parent/{ParentStatementID}
> Example request:

```bash
curl -X DELETE \
    "auditingWithTenancy/DeleteInKind/1/Parent/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "auditingWithTenancy/DeleteInKind/1/Parent/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE DeleteInKind/{InKindID}/Parent/{ParentStatementID}`


<!-- END_46309309c50828ed0e5df95c0e2bcbe9 -->


