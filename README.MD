# rest-api

This is a POC rest-api with JWT for authentication. 

## How does it work?

Client does `GET /` and gets an Access-Token looking like this:
```eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyZWFkIjp0cnVlLCJ3cml0ZSI6ZmFsc2UsImV4cGlyZXNBdCI6IjIwMTctMTAtMjYgMTM6MDk6MzYifQ.5lB0Xxw2IxIA53K9Inoglb5uaVexcUFvxGoGN0B3QeI```

This token is a read only token, tokens that can read AND write are currently supposed to be issued manually.
The default read only token expires in 5 days. So after 5 days you need to get a new one.

Every request you want to do from now on should include your token. 
If you want to access the /search endpoint which is secured by read only access, you need to pass your token in the headers.

Another endpoint e.g. /index could require write access so your token needs to include that permission.

Every token (read or read/write) are signed with a secret (contents of "secret")

## Feedback

This is my first time designing the security for a rest-api and I just wanted to try out some technologies.
If you have any ideas for improvement, I would be grateful if you could create an issue.