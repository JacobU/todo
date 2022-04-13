curl --location -g --request POST 'localhost:80/todo' \
--data-raw '{
    "name":"test",
    "description":"descriptiontest",
    "due_date":"",
    "is_complete": false
}'