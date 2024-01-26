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
                <code class="higlighted break-word">https://app.chronogrid.com/api/register</code>
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
                    <td>name</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Company name</td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>String</td>
                    <td><span class="required-col">required</span><span class="required-col">unique</span></td>
                    <td>Email Company</td>
                </tr>
                <tr>
                    <td>subscription_id</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Subscription checked id</td>
                </tr>
                <tr>
                    <td>address1</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Address</td>
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
                <tr>
                    <td>state</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>State</td>
                </tr>
                <tr>
                    <td>postal_code</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Postal code</td>
                </tr>
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="register-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
        "status": true,
        "message": "Waiting in access with administrator",
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="register-errors">
            <h2>Errors</h2>

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
                    <td>System error</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
