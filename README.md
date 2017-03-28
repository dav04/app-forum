[![Published on webcomponents.org](https://img.shields.io/badge/webcomponents.org-published-blue.svg)](https://www.webcomponents.org/element/dav04/app-forum)

## Introduction
**app-forum** is a Polymer Web Component that can be used to create a simple forum in a website that uses any type of database through the inner use of json array as data structures. It also allows to integrate all users of a site that uses **app-forum**.

Every single operation is protected by an **id** and a **token** of each user (**forumEdit** event) that allows the server to check authenticity of the user and catch any editing operation in **editEvent** property.

API and DEMO: [GitHub](https://dav04.github.io/app-forum/components/app-forum/)
 
## Login
It is possible to login inside the forum by listening to the **loginUserForum** event, where you will receive the username (**data.detail.username**) and password (**data.detail.password**) and send them to your server, check correctness and respond with an **id** and **token** of the authenticated user using the **getToken** event.

If a user logs in main site, your server has to fire a new **getToken** event, sending to **app-forum** the user id and token who will be automatically authenticated.
Example:
```javascript
...
var event = new CustomEvent("getToken", {detail: {id: "1", token: "abc1234"}});
document.querySelector('app-forum').dispatchEvent(event);
```
### Important: 
**getToken** event must have the data structure as shown above, with **id** and **token** in the object.
 
## Logout
Users can logout from the forum by listening to **logoutUserForum** event, authentication data (id and token of user) will be passed in the object.

In addition a user can log out from the main website, in this case the server has to fire a new **logoutUser** event to be sent to forum component.
 
## Elements
The first element that has to be set as property is **user**; for every user in this array,
it must have these fields: **id**, **nickname**, **account**, **avatar**.

**account** field can be set to **1** for __admins__, who can edit forum structure, or **2** for __users__.
Example:
```html
<app-forum user='[{"id":1,"nickname": "admin", "account": 1, "avatar": "images/users/avatar1.png"}, {"id":2, "nickname": "user", "account": 2, "avatar": "images/users/avatar2.png"}]'></app-forum>
```
The other elements that can be set are:

|Property    | Fields|
|----        |----------|
|**area**      | **id**, **title**, **priv**|
|              | **priv** is privilege: **0** can be seen by all users, **1** can be seen only by admins|
|**section**   | **id**, **area**, **title**, **description**, **subsection**|
|**topic**     | **id**, **section**, **title**, **status**, **date**|
|              | **status** can only be **open** or **close**|
|**post**      | **id**, **topic**, **message**, **user**, **date**|

Format of **date** field is **YYYY-MM-DD HH:MI:SS**

Example with **area** and **section** property:
```html
<app-forum user='[{"id":1,"nickname": "admin", "account": 1, "avatar": "images/users/avatar1.png"}, {"id":2, "nickname": "user", "account": 2, "avatar": "images/users/avatar2.png"}]' 
area='[{"id":1, "title": "Area 1", "priv": 0}, {"id":2, "title": "Area 2", "priv": 1}]' 
section='[{"id":1, "area": 1, "title": "Section 1", "description": "Description 1", "subsection": null}, {"id":2, "area": 2, "title": "Section 2", "description": "Description 2", "subsection": null}, {"id":3, "area": 1, "title": "Section 3", "description": "Description 3", "subsection": null}, {"id":4, "area": 1, "title": "Section 4", "description": "Description 4", "subsection": 1}]'>
</app-forum>
```
## Forum edit operations
When a **forumEdit** event is fired, two fields are passed through: **type** and **auth**.

**auth** has **id** and **token** of a user, allowing server to check if authentication is correct and catch from **editForum** property the element edited in forum.
 
**type** field lets you recognize the operation, following the list below:

|Type            | Description           | Fields|
|----------      |-------------          |----------|
|**reply**         | Reply to a post       | **id**, **message**, **typeid** (topic id)|
|**editPost**      | Post edited           | **message**, **typeid** (post id)|
|**deletePost**    | Post deleted          | **id**, **topic**, **message**, **user**, **date**|
|**editTopic**     | Topic edited          | **id** (topic id), **title**, **message**, **typeid** (post id)|
|**newTopic**      | New topic created     | **id**, **title**, **message**, **postid**, **typeid** (section id)|
|**newArea**       | New area created      | **id**, **title**, **priv**|
|**editArea**      | Area edited           | **id**, **title**, **priv**|
|**deleteArea**    | Area deleted          | **id**, **title**, **priv**|
|**newSection**    | New Section created   | **id**, **area**, **title**, **description**, **subsection**|
|**editSection**   | Section edited        | **id**, **area**, **title**, **description**, **subsection**|
|**deleteSection** | Section deleted       | **id**, **area**, **title**, **description**, **subsection**|     
 
## Style
|Custom property                 | Description                               | Default|
|----------------                |-------------                              |----------|
|**--forum-primary-color**         | Background color                          | #82bfc8|
|**--forum-primary-text-color**    | Text color on background                  | black|
|**--forum-secondary-color**       | Toolbar, buttons and inputs color         | #1d7fa9|
|**--forum-secondary-text-color**  | Text color on toolbar, buttons and inputs | white|
|**--app-forum**                   | Mixin applied to forum                    | {}|
