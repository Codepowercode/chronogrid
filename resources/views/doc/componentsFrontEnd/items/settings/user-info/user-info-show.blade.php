<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="user-info-show-get-started">
            <h1>Show user info</h1>
            <p>
                Show auth user information API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="user-info-show-get-characters">
            <h2><span class="request-method">get</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/settings/profile/show</code>
            </p>
            <br>
            <h4>QUERY PARAMETERS</h4>
            <table>
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Importance</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>access_token</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Your API access key. (header)</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="overflow-hidden content-section" id="user-info-show-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
      "data": {
        "id": 1,
        "name": "admin",
        "email": "admin@gmail.com",
        "info": [
            {
                "id": 15,
                "address1": "asd",
                "address2": "asd",
                "city": "asdasd",
                "state": "asdasd",
                "postal_code": "asd",
                "phone_number": "asd",
                "fax_number": "asd",
                "website": "asd",
                "skype": "asd",
                "cell_phone": "asd",
                "company_type": "asd",
                "country": "asda",
                "business_type": "sda",
                "premium": "sd"
            },
            {
                "id": 16,
                "address1": "asda",
                "address2": "sd",
                "city": "asd",
                "state": "asd",
                "postal_code": "asd",
                "phone_number": "asd",
                "fax_number": "asda",
                "website": "asda",
                "skype": "sd",
                "cell_phone": "asd",
                "company_type": "asd",
                "country": "asd",
                "business_type": "asda",
                "premium": "sd"
            }
        ]
      }
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="user-info-show-errors">
            <h2>Errors</h2>
{{--            <p>--}}
{{--                The Westeros API uses the following error codes:--}}
{{--            </p>--}}
            <table>
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
