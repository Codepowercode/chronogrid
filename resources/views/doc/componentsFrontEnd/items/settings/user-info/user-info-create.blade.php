<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="user-info-create-get-started">
            <h1>Create user info</h1>
            <p>
                Create user information API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="user-info-create-get-characters">
            <h2><span class="request-method">post</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/settings/profile/create</code>
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
                <tr>
                    <td>info</td>
                    <td>Array</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>address1</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Address 1</td>
                </tr>
                <tr>
                    <td>address2</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Address 2</td>
                </tr>
                <tr>
                    <td>city</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>City</td>
                </tr>
                <tr>
                    <td>state</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>State</td>
                </tr>
                <tr>
                    <td>postal_code</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Postal code</td>
                </tr>
                <tr>
                    <td>phone_number</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Phone number</td>
                </tr>
                <tr>
                    <td>fax_number</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Fax number</td>
                </tr>
                <tr>
                    <td>website</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Web site</td>
                </tr>
                <tr>
                    <td>skype</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Skype</td>
                </tr>
                <tr>
                    <td>cell_phone</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Cell phone</td>
                </tr>
                <tr>
                    <td>company_type</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Company type</td>
                </tr>
                <tr>
                    <td>country</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>country</td>
                </tr>
                <tr>
                    <td>business_type</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Business type</td>
                </tr>
                <tr>
                    <td>premium</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>Premium</td>
                </tr>
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="user-info-create-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
      "status": true,
      "message": "Successfully reset password",
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="user-info-create-errors">
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
