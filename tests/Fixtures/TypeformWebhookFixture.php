<?php

namespace Tests\Fixtures;

class TypeformWebhookFixture
{
    public static function get()
    {
        return json_decode('{
            "event_id": "01DGMP0D8BC2CXBK3R5SGTA1D2",
            "event_type": "form_response",
            "form_response": {
              "form_id": "XLOUWc",
              "token": "01DGMP0D8BC2CXBK3R5SGTA1D2",
              "landed_at": "2019-07-25T13:44:27Z",
              "submitted_at": "2019-07-25T13:44:27Z",
              "definition": {
                "id": "XLOUWc",
                "title": "THREAD Poets for Science AWP — What Does A River Know? (copy)",
                "fields": [
                  {
                    "id": "daTuJnaO4l9H",
                    "title": "What does the river know…\nIf the river were personified, what sensations would it experience? What cycles does the river know? Where does it go? What secrets does it have access to?",
                    "type": "long_text",
                    "ref": "content",
                    "properties": {}
                  },
                  {
                    "id": "I40E94fqMPLF",
                    "title": "OPTIONAL: What\'s your name?",
                    "type": "short_text",
                    "ref": "name",
                    "properties": {}
                  },
                  {
                    "id": "MIXBKDYLjEUH",
                    "title": "OPTIONAL: What city are you from?",
                    "type": "short_text",
                    "ref": "city",
                    "properties": {}
                  },
                  {
                    "id": "ixtHoKrLkDNY",
                    "title": "OPTIONAL: Enter your email if you\'d like to receive a copy of your submission.",
                    "type": "email",
                    "ref": "email",
                    "properties": {}
                  }
                ]
              },
              "answers": [
                {
                  "type": "text",
                  "text": "Lorem ipsum dolor",
                  "field": {
                    "id": "daTuJnaO4l9H",
                    "type": "long_text",
                    "ref": "content"
                  }
                },
                {
                  "type": "text",
                  "text": "Lorem ipsum dolor",
                  "field": {
                    "id": "I40E94fqMPLF",
                    "type": "short_text",
                    "ref": "name"
                  }
                },
                {
                  "type": "text",
                  "text": "Lorem ipsum dolor",
                  "field": {
                    "id": "MIXBKDYLjEUH",
                    "type": "short_text",
                    "ref": "city"
                  }
                },
                {
                  "type": "email",
                  "email": "an_account@example.com",
                  "field": {
                    "id": "ixtHoKrLkDNY",
                    "type": "email",
                    "ref": "email"
                  }
                }
              ]
            }
          }', true);
    }
}
