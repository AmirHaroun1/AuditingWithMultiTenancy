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
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Manage OfficeBranches


APIs To Manage OfficeBranches
<!-- START_8cc9fd4169b2125d7dda5538d73ecc44 -->
## In case of  response expects json it retrieves all office_branches
&lt;br&gt;
In case of normal response it return the blade SuperAdmin/OfficeBranches/index.php
, your component is their &lt;office-branches&gt;&lt;/office-branches&gt; , load all branches through the same endpoint
route(&#039; OfficeBranches.index &#039;)

> Example request:

```bash
curl -X GET \
    -G "http://localhost/SuperAdmin/OfficeBranches" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/OfficeBranches"
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
`GET SuperAdmin/OfficeBranches`


<!-- END_8cc9fd4169b2125d7dda5538d73ecc44 -->

<!-- START_f198c1ff9139ae14fb803e1a2a474f0d -->
## Store a newly created Office in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/SuperAdmin/OfficeBranches" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"nobis","address":"quis","is_main":"voluptatem"}'

```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/OfficeBranches"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "nobis",
    "address": "quis",
    "is_main": "voluptatem"
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
`POST SuperAdmin/OfficeBranches`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | required |  optional  | string the name of the office_branch
        `address` | required |  optional  | string the address of the office_branch
        `is_main` | required |  optional  | boolean if the branch is main checkbox returns 1 or 0
    
<!-- END_f198c1ff9139ae14fb803e1a2a474f0d -->

<!-- START_c08db2a58cf1d1a812bf254fbe06e808 -->
## Update the specified office_branch in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/SuperAdmin/OfficeBranches/enim" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"cupiditate","address":"quibusdam","is_main":"eius"}'

```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/OfficeBranches/enim"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "cupiditate",
    "address": "quibusdam",
    "is_main": "eius"
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
`PUT SuperAdmin/OfficeBranches/{OfficeBranch}`

`PATCH SuperAdmin/OfficeBranches/{OfficeBranch}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `OfficeBranch` |  required  | int the id of the updated office
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | required |  optional  | string the name of the office_branch
        `address` | required |  optional  | string the address of the office_branch
        `is_main` | required |  optional  | boolean if the branch is main checkbox returns 1 or 0
    
<!-- END_c08db2a58cf1d1a812bf254fbe06e808 -->

#Manage Transactions


APIs To Manage Transactions
<!-- START_6d277522f7ffa5cb792224b642ab5c58 -->
## in case of json response Retrieve The Transactions of the current user in this branch.

<br>
if the Auth User is 'مدير مراجعة ' and his office_branch.is_main all transactions would be retrieved
<br>
and based on the above condition you should show taps of available branches load them through the following end point.
,route('OfficeBranches.index'), on clicking on any name of the branches send it as query param 'BranchOfficeID'
<br>
in case of non json response Returns Blade Transactions/index.blade.php.
<br>

> Example request:

```bash
curl -X GET \
    -G "http://localhost/Secretary/Transactions?BranchOfficeID=et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Secretary/Transactions"
);

let params = {
    "BranchOfficeID": "et",
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
`GET Secretary/Transactions`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `OrderByCase` |  optional  | optional param of the OrderBy [Latest,oldest].
    `MainRegisterNumber` |  optional  | optional param of the Search TreadRegister.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `BranchOfficeID` |  optional  | optional param if the Auth User.role is 'مدير مراجعة' and his User.office_branch.is_main

<!-- END_6d277522f7ffa5cb792224b642ab5c58 -->

<!-- START_d732a768110d6845a77f40f1bdab652b -->
## Secretary/CreateTransaction
> Example request:

```bash
curl -X GET \
    -G "http://localhost/Secretary/CreateTransaction" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Secretary/CreateTransaction"
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
`GET Secretary/CreateTransaction`


<!-- END_d732a768110d6845a77f40f1bdab652b -->

<!-- START_a1947c3bee1d91922c6982e912d6b726 -->
## Secretary/StoreNewTransaction/institution/{institution}/reviser/{reviser}
> Example request:

```bash
curl -X POST \
    "http://localhost/Secretary/StoreNewTransaction/institution/1/reviser/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Secretary/StoreNewTransaction/institution/1/reviser/1"
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
    -G "http://localhost/Secretary/PrintReceiptVoucher/TransactionYear/1/CompanyName/1/PaymentType/1/PaymentValue/1/ReviserCompanyName/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Secretary/PrintReceiptVoucher/TransactionYear/1/CompanyName/1/PaymentType/1/PaymentValue/1/ReviserCompanyName/1"
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
`GET Secretary/PrintReceiptVoucher/TransactionYear/{TransactionYear}/CompanyName/{CompanyName}/PaymentType/{PaymentType}/PaymentValue/{PaymentValue}/ReviserCompanyName/{ReviserCompanyName}`


<!-- END_e854c86341294e905847a916d97e7789 -->

<!-- START_9b72df565d7dfd9197882b71bf5f32c7 -->
## Secretary/EngagementLetter/institution/{institution}/transaction/{transaction}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/Secretary/EngagementLetter/institution/1/transaction/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Secretary/EngagementLetter/institution/1/transaction/1"
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
`GET Secretary/EngagementLetter/institution/{institution}/transaction/{transaction}`


<!-- END_9b72df565d7dfd9197882b71bf5f32c7 -->

<!-- START_d4c414cb492ea47627539046a81d3e97 -->
## Secretary/EditTransaction/{Transaction_id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/Secretary/EditTransaction/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Secretary/EditTransaction/1"
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
`GET Secretary/EditTransaction/{Transaction_id}`


<!-- END_d4c414cb492ea47627539046a81d3e97 -->

<!-- START_55dbd816f1bc022603fcafce5b09043c -->
## in case of json response Retrieve The Transactions of the current user in this branch.

<br>
if the Auth User is 'مدير مراجعة ' and his office_branch.is_main all transactions would be retrieved
<br>
and based on the above condition you should show taps of available branches load them through the following end point.
,route('OfficeBranches.index'), on clicking on any name of the branches send it as query param 'BranchOfficeID'
<br>
in case of non json response Returns Blade Transactions/index.blade.php.
<br>

> Example request:

```bash
curl -X GET \
    -G "http://localhost/Reviser/Transactions?BranchOfficeID=saepe" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Reviser/Transactions"
);

let params = {
    "BranchOfficeID": "saepe",
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
`GET Reviser/Transactions`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `OrderByCase` |  optional  | optional param of the OrderBy [Latest,oldest].
    `MainRegisterNumber` |  optional  | optional param of the Search TreadRegister.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `BranchOfficeID` |  optional  | optional param if the Auth User.role is 'مدير مراجعة' and his User.office_branch.is_main

<!-- END_55dbd816f1bc022603fcafce5b09043c -->

<!-- START_1fb718b37a400eab192f2ec08a3e1386 -->
## Reviser/EditTransaction/{Transaction_id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/Reviser/EditTransaction/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Reviser/EditTransaction/1"
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
`GET Reviser/EditTransaction/{Transaction_id}`


<!-- END_1fb718b37a400eab192f2ec08a3e1386 -->

<!-- START_364c699b097e22a56928b3a479bdefa2 -->
## in case of json response Retrieve The Transactions of the current user in this branch.

<br>
if the Auth User is 'مدير مراجعة ' and his office_branch.is_main all transactions would be retrieved
<br>
and based on the above condition you should show taps of available branches load them through the following end point.
,route('OfficeBranches.index'), on clicking on any name of the branches send it as query param 'BranchOfficeID'
<br>
in case of non json response Returns Blade Transactions/index.blade.php.
<br>

> Example request:

```bash
curl -X GET \
    -G "http://localhost/TechnicalAuditor/Transactions?BranchOfficeID=consequuntur" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/TechnicalAuditor/Transactions"
);

let params = {
    "BranchOfficeID": "consequuntur",
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
`GET TechnicalAuditor/Transactions`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `OrderByCase` |  optional  | optional param of the OrderBy [Latest,oldest].
    `MainRegisterNumber` |  optional  | optional param of the Search TreadRegister.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `BranchOfficeID` |  optional  | optional param if the Auth User.role is 'مدير مراجعة' and his User.office_branch.is_main

<!-- END_364c699b097e22a56928b3a479bdefa2 -->

<!-- START_b07a64e5465844402dd36d538ccea707 -->
## TechnicalAuditor/EditTransaction/{Transaction_id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/TechnicalAuditor/EditTransaction/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/TechnicalAuditor/EditTransaction/1"
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
`GET TechnicalAuditor/EditTransaction/{Transaction_id}`


<!-- END_b07a64e5465844402dd36d538ccea707 -->

<!-- START_1fec506264869d28d11347ff9e4741ae -->
## in case of json response Retrieve The Transactions of the current user in this branch.

<br>
if the Auth User is 'مدير مراجعة ' and his office_branch.is_main all transactions would be retrieved
<br>
and based on the above condition you should show taps of available branches load them through the following end point.
,route('OfficeBranches.index'), on clicking on any name of the branches send it as query param 'BranchOfficeID'
<br>
in case of non json response Returns Blade Transactions/index.blade.php.
<br>

> Example request:

```bash
curl -X GET \
    -G "http://localhost/AllTransactions/qui/ea?BranchOfficeID=labore" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/AllTransactions/qui/ea"
);

let params = {
    "BranchOfficeID": "labore",
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


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET AllTransactions/{OrderByCase?}/{MainRegisterNumber?}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `OrderByCase` |  optional  | optional param of the OrderBy [Latest,oldest].
    `MainRegisterNumber` |  optional  | optional param of the Search TreadRegister.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `BranchOfficeID` |  optional  | optional param if the Auth User.role is 'مدير مراجعة' and his User.office_branch.is_main

<!-- END_1fec506264869d28d11347ff9e4741ae -->

<!-- START_0b596fe756ab3db6b27156ba5bf0e58d -->
## in case of json response Retrieve The Transactions of the current user in this branch.

<br>
if the Auth User is 'مدير مراجعة ' and his office_branch.is_main all transactions would be retrieved
<br>
and based on the above condition you should show taps of available branches load them through the following end point.
,route('OfficeBranches.index'), on clicking on any name of the branches send it as query param 'BranchOfficeID'
<br>
in case of non json response Returns Blade Transactions/index.blade.php.
<br>

> Example request:

```bash
curl -X GET \
    -G "http://localhost/ManagementPartner/Transactions?BranchOfficeID=repudiandae" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/ManagementPartner/Transactions"
);

let params = {
    "BranchOfficeID": "repudiandae",
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
`GET ManagementPartner/Transactions`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `OrderByCase` |  optional  | optional param of the OrderBy [Latest,oldest].
    `MainRegisterNumber` |  optional  | optional param of the Search TreadRegister.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `BranchOfficeID` |  optional  | optional param if the Auth User.role is 'مدير مراجعة' and his User.office_branch.is_main

<!-- END_0b596fe756ab3db6b27156ba5bf0e58d -->

<!-- START_6ecd326c9c37802ad1941fff40eb4156 -->
## ManagementPartner/EditTransaction/{Transaction_id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/ManagementPartner/EditTransaction/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/ManagementPartner/EditTransaction/1"
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
`GET ManagementPartner/EditTransaction/{Transaction_id}`


<!-- END_6ecd326c9c37802ad1941fff40eb4156 -->

<!-- START_5569e6a7379a2531cc31c7dd050cbea5 -->
## in case of json response Retrieve The Transactions of the current user in this branch.

<br>
if the Auth User is 'مدير مراجعة ' and his office_branch.is_main all transactions would be retrieved
<br>
and based on the above condition you should show taps of available branches load them through the following end point.
,route('OfficeBranches.index'), on clicking on any name of the branches send it as query param 'BranchOfficeID'
<br>
in case of non json response Returns Blade Transactions/index.blade.php.
<br>

> Example request:

```bash
curl -X GET \
    -G "http://localhost/RevisingManager/Transactions?BranchOfficeID=et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/RevisingManager/Transactions"
);

let params = {
    "BranchOfficeID": "et",
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
`GET RevisingManager/Transactions`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `OrderByCase` |  optional  | optional param of the OrderBy [Latest,oldest].
    `MainRegisterNumber` |  optional  | optional param of the Search TreadRegister.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `BranchOfficeID` |  optional  | optional param if the Auth User.role is 'مدير مراجعة' and his User.office_branch.is_main

<!-- END_5569e6a7379a2531cc31c7dd050cbea5 -->

<!-- START_9ea264c602c87d48a179126313b11fba -->
## RevisingManager/EditTransaction/{Transaction_id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/RevisingManager/EditTransaction/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/RevisingManager/EditTransaction/1"
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
`GET RevisingManager/EditTransaction/{Transaction_id}`


<!-- END_9ea264c602c87d48a179126313b11fba -->

<!-- START_2d06c5c20cf8972e518a63e9e061531c -->
## in case of json response Retrieve The Transactions of the current user in this branch.

<br>
if the Auth User is 'مدير مراجعة ' and his office_branch.is_main all transactions would be retrieved
<br>
and based on the above condition you should show taps of available branches load them through the following end point.
,route('OfficeBranches.index'), on clicking on any name of the branches send it as query param 'BranchOfficeID'
<br>
in case of non json response Returns Blade Transactions/index.blade.php.
<br>

> Example request:

```bash
curl -X GET \
    -G "http://localhost/ArchiveSecretary/Transactions?BranchOfficeID=accusamus" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/ArchiveSecretary/Transactions"
);

let params = {
    "BranchOfficeID": "accusamus",
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
`GET ArchiveSecretary/Transactions`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `OrderByCase` |  optional  | optional param of the OrderBy [Latest,oldest].
    `MainRegisterNumber` |  optional  | optional param of the Search TreadRegister.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `BranchOfficeID` |  optional  | optional param if the Auth User.role is 'مدير مراجعة' and his User.office_branch.is_main

<!-- END_2d06c5c20cf8972e518a63e9e061531c -->

<!-- START_94e0e7bd8c2a61f640dd7a56dcd1266d -->
## UpdateTransaction/{transaction}
> Example request:

```bash
curl -X PATCH \
    "http://localhost/UpdateTransaction/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/UpdateTransaction/1"
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
    "http://localhost/UpdateTransactionActualTime/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/UpdateTransactionActualTime/1"
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

#dashboard


<!-- START_2534e8474f687fe3cf8e4b7f63532ad8 -->
## Retrieve Dash Board Data

> Example request:

```bash
curl -X GET \
    -G "http://localhost/SuperAdmin/dashboard" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/dashboard"
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
`GET SuperAdmin/dashboard`


<!-- END_2534e8474f687fe3cf8e4b7f63532ad8 -->

#general


<!-- START_66e08d3cc8222573018fed49e121e96d -->
## Show the application&#039;s login form.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/login"
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
    "http://localhost/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/login"
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
    "http://localhost/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/logout"
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
    -G "http://localhost/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/register"
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
    "http://localhost/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/register"
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
    -G "http://localhost/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset"
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
    "http://localhost/password/email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/email"
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
    -G "http://localhost/password/reset/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset/1"
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
    "http://localhost/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset"
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
    -G "http://localhost/password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/confirm"
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
    "http://localhost/password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/confirm"
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

<!-- START_17eaf4e22b80b4b4cd74cb358011f837 -->
## SuperAdmin/ManageEmployees
> Example request:

```bash
curl -X GET \
    -G "http://localhost/SuperAdmin/ManageEmployees" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/ManageEmployees"
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
`GET SuperAdmin/ManageEmployees`


<!-- END_17eaf4e22b80b4b4cd74cb358011f837 -->

<!-- START_3c3b771a781d3ca15518c0820ab17f40 -->
## SuperAdmin/AddEmployee
> Example request:

```bash
curl -X GET \
    -G "http://localhost/SuperAdmin/AddEmployee" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/AddEmployee"
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
`GET SuperAdmin/AddEmployee`


<!-- END_3c3b771a781d3ca15518c0820ab17f40 -->

<!-- START_54e460c8f169ebf722d5cf3a4c017462 -->
## SuperAdmin/StoreNewEmployee
> Example request:

```bash
curl -X POST \
    "http://localhost/SuperAdmin/StoreNewEmployee" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/StoreNewEmployee"
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
    -G "http://localhost/SuperAdmin/EditEmployee/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/EditEmployee/1"
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
`GET SuperAdmin/EditEmployee/{employee}`


<!-- END_957f95b0a6a789429bf67bcd2d99c368 -->

<!-- START_c0097fb938a7c5656260095e235e023b -->
## SuperAdmin/UpdateEmployee/{employee}
> Example request:

```bash
curl -X PATCH \
    "http://localhost/SuperAdmin/UpdateEmployee/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/UpdateEmployee/1"
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
    "http://localhost/SuperAdmin/DeleteEmployee/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/DeleteEmployee/1"
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
    -G "http://localhost/SuperAdmin/ManageDropDowns" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/ManageDropDowns"
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
`GET SuperAdmin/ManageDropDowns`


<!-- END_d7a0b83ad67cb087b49dc063f40173b8 -->

<!-- START_5b6007c4cf6751367584794a865fc1d9 -->
## SuperAdmin/StoreDropDownsOption
> Example request:

```bash
curl -X POST \
    "http://localhost/SuperAdmin/StoreDropDownsOption" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/StoreDropDownsOption"
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
    "http://localhost/SuperAdmin/DeleteDropDownsOption/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/DeleteDropDownsOption/1"
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
    "http://localhost/SuperAdmin/UpdateDropDownsOption/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/UpdateDropDownsOption/1"
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
    -G "http://localhost/SuperAdmin/AccountCharts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/AccountCharts"
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
`GET SuperAdmin/AccountCharts`


<!-- END_05634d0b48e2852d39d4fbdbaa35aa20 -->

<!-- START_b9c4e42ef6b75a561c5c392bfeb76041 -->
## SuperAdmin/StoreAccountChart
> Example request:

```bash
curl -X POST \
    "http://localhost/SuperAdmin/StoreAccountChart" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/StoreAccountChart"
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
    "http://localhost/SuperAdmin/DeleteAccountChart/1/level/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/DeleteAccountChart/1/level/1"
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
    "http://localhost/SuperAdmin/UpdateAccountChart" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/UpdateAccountChart"
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
    -G "http://localhost/SuperAdmin/ManageRevisingGuid" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/ManageRevisingGuid"
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
`GET SuperAdmin/ManageRevisingGuid`


<!-- END_8dddea86e904cd3fb183244209e241a7 -->

<!-- START_558de8f648dce0a7bb492d6153f9e732 -->
## SuperAdmin/UpdateRevisingGuid/{RevisingGuidID}
> Example request:

```bash
curl -X PATCH \
    "http://localhost/SuperAdmin/UpdateRevisingGuid/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/UpdateRevisingGuid/1"
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
    "http://localhost/SuperAdmin/StoreNewRevisingGuid" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/StoreNewRevisingGuid"
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
    "http://localhost/SuperAdmin/DeleteRevisingGuid/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/DeleteRevisingGuid/1"
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
    -G "http://localhost/SuperAdmin/ManageFinancialGroups" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/ManageFinancialGroups"
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
`GET SuperAdmin/ManageFinancialGroups`


<!-- END_f9400f7c499d682f68ffe1f1d29e0c38 -->

<!-- START_7426112565bf00a27d9cb34c8db5b19c -->
## SuperAdmin/UpdateFinancialGroup//{FinancialGroupID}
> Example request:

```bash
curl -X PATCH \
    "http://localhost/SuperAdmin/UpdateFinancialGroup//1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/UpdateFinancialGroup//1"
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
    "http://localhost/SuperAdmin/StoreNewFinancialGroup" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/StoreNewFinancialGroup"
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
    "http://localhost/SuperAdmin/DeleteFinancialGroup/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/DeleteFinancialGroup/1"
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
    "http://localhost/SuperAdmin/LinkAccountToFinancialGroup/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/LinkAccountToFinancialGroup/1"
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
    "http://localhost/SuperAdmin/UnLinkAccountFromFinancialGroup/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/SuperAdmin/UnLinkAccountFromFinancialGroup/1"
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

<!-- START_45dd1b2f537f7ac326d9a84ab6a08555 -->
## Secretary/StoreNewInstitution
> Example request:

```bash
curl -X POST \
    "http://localhost/Secretary/StoreNewInstitution" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Secretary/StoreNewInstitution"
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
    "http://localhost/Secretary/UpdateInstitution/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Secretary/UpdateInstitution/1"
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
    "http://localhost/Secretary/StoreNewAgentFor/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Secretary/StoreNewAgentFor/1"
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
    "http://localhost/Secretary/UpdateAgent/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Secretary/UpdateAgent/1"
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
    "http://localhost/Secretary/SearchNewRegister" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Secretary/SearchNewRegister"
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
    "http://localhost/Secretary/StoreNewRegisterTrade/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Secretary/StoreNewRegisterTrade/1"
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
    "http://localhost/Secretary/UpdateRegister/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Secretary/UpdateRegister/1"
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
    "http://localhost/Secretary/DeleteTradeRegister/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Secretary/DeleteTradeRegister/1"
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

<!-- START_c09a45cdf2997a5b3320db710a34dc2e -->
## TechnicalAuditor/AccountAvailableForExcelLinking/{TransactionID}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/TechnicalAuditor/AccountAvailableForExcelLinking/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/TechnicalAuditor/AccountAvailableForExcelLinking/1"
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
`GET TechnicalAuditor/AccountAvailableForExcelLinking/{TransactionID}`


<!-- END_c09a45cdf2997a5b3320db710a34dc2e -->

<!-- START_7de04b9912a4b03bcbb443e7af56bc5b -->
## TechnicalAuditor/GetUploadedAccountsExcelHeaders
> Example request:

```bash
curl -X POST \
    "http://localhost/TechnicalAuditor/GetUploadedAccountsExcelHeaders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/TechnicalAuditor/GetUploadedAccountsExcelHeaders"
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
    "http://localhost/TechnicalAuditor/StoreNewBranchedStatementAddedByExcel" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/TechnicalAuditor/StoreNewBranchedStatementAddedByExcel"
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
    "http://localhost/TechnicalAuditor/DeleteExistingBranchedStatementAddedByExcel/1/WhoseParent/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/TechnicalAuditor/DeleteExistingBranchedStatementAddedByExcel/1/WhoseParent/1"
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

<!-- START_d5665895acd9a1cacd85e3afbc8eebb4 -->
## ArchiveSecretary/RevisingGuid/Transaction/{TransactionsID}/{WithRelation?}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/ArchiveSecretary/RevisingGuid/Transaction/1/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/ArchiveSecretary/RevisingGuid/Transaction/1/"
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
`GET ArchiveSecretary/RevisingGuid/Transaction/{TransactionsID}/{WithRelation?}`


<!-- END_d5665895acd9a1cacd85e3afbc8eebb4 -->

<!-- START_bc4596e98655a9bfd23f7a8d65deb40b -->
## ArchiveSecretary/RevisingGuidList/{transactionID}/Guide/{RevisingGuidID}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/ArchiveSecretary/RevisingGuidList/1/Guide/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/ArchiveSecretary/RevisingGuidList/1/Guide/1"
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
`GET ArchiveSecretary/RevisingGuidList/{transactionID}/Guide/{RevisingGuidID}`


<!-- END_bc4596e98655a9bfd23f7a8d65deb40b -->

<!-- START_5dec26b13b5dea8f855ddec159cc0757 -->
## ArchiveSecretary/UpdateArchiveRecord/{transactionID}
> Example request:

```bash
curl -X PATCH \
    "http://localhost/ArchiveSecretary/UpdateArchiveRecord/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/ArchiveSecretary/UpdateArchiveRecord/1"
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
    "http://localhost/ArchiveSecretary/StoreArchiveRecord/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/ArchiveSecretary/StoreArchiveRecord/1"
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
    -G "http://localhost/OfficeInfo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/OfficeInfo"
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
`GET OfficeInfo`


<!-- END_5799883540e324eb5f2e9e0eb487b491 -->

<!-- START_5dffa5d874d356dee215df0955901ccc -->
## StoreOfficeInfo
> Example request:

```bash
curl -X POST \
    "http://localhost/StoreOfficeInfo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/StoreOfficeInfo"
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
    "http://localhost/UpdateOfficeInfo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/UpdateOfficeInfo"
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

<!-- START_388895b6c6e11957e4ab353fce76fc68 -->
## Documents/{transactionID?}/document/{documentCode?}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/Documents//document/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/Documents//document/"
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
    "http://localhost/AddTransactionDocumentFor/1/document/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/AddTransactionDocumentFor/1/document/1"
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
    "http://localhost/RemoveTransactionDocument/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/RemoveTransactionDocument/1"
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
    -G "http://localhost/DownloadDocuments/1/name/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/DownloadDocuments/1/name/1"
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
`GET DownloadDocuments/{documentPath}/name/{documentName}`


<!-- END_1d1c334e2c56bfd93a2986c3c5adfa67 -->

<!-- START_4c361e7942ca643a1235a2b1944610d5 -->
## AddDocumentComment
> Example request:

```bash
curl -X PATCH \
    "http://localhost/AddDocumentComment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/AddDocumentComment"
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
    -G "http://localhost/GetDropDownsOptions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/GetDropDownsOptions"
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
`GET GetDropDownsOptions`


<!-- END_05297f634950a05fe1a783be045ad776 -->

<!-- START_c9977da86355d0ef913c0bebc35b015c -->
## GetEmployeesType/{employees_type}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/GetEmployeesType/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/GetEmployeesType/1"
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
`GET GetEmployeesType/{employees_type}`


<!-- END_c9977da86355d0ef913c0bebc35b015c -->

<!-- START_4df1abfe9cf9444a9e01d02441d71ad7 -->
## AllAccountCharts
> Example request:

```bash
curl -X GET \
    -G "http://localhost/AllAccountCharts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/AllAccountCharts"
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
`GET AllAccountCharts`


<!-- END_4df1abfe9cf9444a9e01d02441d71ad7 -->

<!-- START_da87a9d1f1b5cc9f41ec8e85b1bc82f7 -->
## NestedAccountCharts
> Example request:

```bash
curl -X GET \
    -G "http://localhost/NestedAccountCharts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/NestedAccountCharts"
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
`GET NestedAccountCharts`


<!-- END_da87a9d1f1b5cc9f41ec8e85b1bc82f7 -->

<!-- START_486007e4d98acf575ffdf2d762a04ee6 -->
## AllTransactionAccountsTreeWithStatements/{TransactionID}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/AllTransactionAccountsTreeWithStatements/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/AllTransactionAccountsTreeWithStatements/1"
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
`GET AllTransactionAccountsTreeWithStatements/{TransactionID}`


<!-- END_486007e4d98acf575ffdf2d762a04ee6 -->

<!-- START_898768e134b556ed2dc72f5112c601dd -->
## TransactionAccountStatements/{TransactionID}/account/{AccountID}/level/{AccountLevel}/WithoutReadOnlyData/{WithoutReadOnly?}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/TransactionAccountStatements/1/account/1/level/1/WithoutReadOnlyData/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/TransactionAccountStatements/1/account/1/level/1/WithoutReadOnlyData/"
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
`GET TransactionAccountStatements/{TransactionID}/account/{AccountID}/level/{AccountLevel}/WithoutReadOnlyData/{WithoutReadOnly?}`


<!-- END_898768e134b556ed2dc72f5112c601dd -->

<!-- START_62b6f39199f798f877d887188c31c465 -->
## TransactionAccountsWithSumOfStatements/{TransactionID}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/TransactionAccountsWithSumOfStatements/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/TransactionAccountsWithSumOfStatements/1"
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
`GET TransactionAccountsWithSumOfStatements/{TransactionID}`


<!-- END_62b6f39199f798f877d887188c31c465 -->

<!-- START_f58381b562c42b0a6f73b05458d2856f -->
## StoreNewTransactionAccountStatement/{transactionID}
> Example request:

```bash
curl -X POST \
    "http://localhost/StoreNewTransactionAccountStatement/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/StoreNewTransactionAccountStatement/1"
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
    "http://localhost/DeleteTransactionAccountStatements/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/DeleteTransactionAccountStatements/1"
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
    "http://localhost/UpdateTransactionAccountStatement/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/UpdateTransactionAccountStatement/1"
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
    -G "http://localhost/TransactionAccountStatementsWithBranches/1/account/1/level/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/TransactionAccountStatementsWithBranches/1/account/1/level/1"
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
`GET TransactionAccountStatementsWithBranches/{TransactionID}/account/{AccountID}/level/{AccountLevel}`


<!-- END_f41db3195b72335e29d78e8008195597 -->

<!-- START_b8d236d6e42491c75248638b5267362c -->
## StatementReadOnlyDataForAccount/{TransactionID}/account/{Account_id}/Level/{AccountLevel}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/StatementReadOnlyDataForAccount/1/account/1/Level/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/StatementReadOnlyDataForAccount/1/account/1/Level/1"
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
`GET StatementReadOnlyDataForAccount/{TransactionID}/account/{Account_id}/Level/{AccountLevel}`


<!-- END_b8d236d6e42491c75248638b5267362c -->

<!-- START_4e206147115b128fdf4c4a1cda876760 -->
## AccountStatementBranches/{StatementID}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/AccountStatementBranches/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/AccountStatementBranches/1"
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
`GET AccountStatementBranches/{StatementID}`


<!-- END_4e206147115b128fdf4c4a1cda876760 -->

<!-- START_8689f94a2b8b351a453efb198fd12072 -->
## UpdateBranchOfAccountStatement/{BranchedStatementID}
> Example request:

```bash
curl -X PATCH \
    "http://localhost/UpdateBranchOfAccountStatement/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/UpdateBranchOfAccountStatement/1"
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
    "http://localhost/StoreNewBranchedStatement" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/StoreNewBranchedStatement"
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
    -G "http://localhost/AccountsHasInKind/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/AccountsHasInKind/1"
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
`GET AccountsHasInKind/{TransactionID}`


<!-- END_b9e4617c543fd548a96592e6719bb8ad -->

<!-- START_5a6fa771c8596376f973d85390c0d011 -->
## InKind/{AccountStatementID}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/InKind/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/InKind/1"
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
`GET InKind/{AccountStatementID}`


<!-- END_5a6fa771c8596376f973d85390c0d011 -->

<!-- START_c47db7513d9737ee47e99d7f5547c822 -->
## StoreNewInKind
> Example request:

```bash
curl -X POST \
    "http://localhost/StoreNewInKind" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/StoreNewInKind"
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
    "http://localhost/UpdateInKind/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/UpdateInKind/1"
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
    "http://localhost/DeleteInKind/1/Parent/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/DeleteInKind/1/Parent/1"
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


