<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="register-get-started">
            <h1>register</h1>
            <p>
                Register API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="register-get-characters">
            <h2><span class="request-method">post</span> method</h2>
            <p>
                <code class="higlighted break-word">php artisan jwt:secret</code>
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
                    <td>Your API access key.</td>
                </tr>
                <tr>
                    <td>address2</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Address</td>
                </tr>
                <tr>
                    <td>city</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>City</td>
                </tr>
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="register-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
      id: 1,
      first_name: "Jon",
      last_name: "Snow",
      alive: true,
      house: "Stark",
      gender: "m",
      age: 14,
      location: "Winterfell"
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="register-errors">
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
                    <td>status</td>
                    <td>boolean</td>
                    <td>false</td>
                </tr>
                <tr>
                    <td>message</td>
                    <td>string</td>
                    <td>error message</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
