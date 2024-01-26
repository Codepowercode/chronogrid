<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="company-reset-password-get-started">
            <h1>Company reset password</h1>
            <p>
                Company reset password API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="company-reset-password-get-characters">
            <h2><span class="request-method">post</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/settings/company/reset/password</code>
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
                    <td>password</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter password</td>
                </tr>
                <tr>
                    <td>confirm_password</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter confirm password</td>
                </tr>
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="company-reset-password-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
        "status": true,
        "message": "Successfully reset password",
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="company-reset-password-errors">
            <h2>Errors</h2>
            <p>
                Equal password
            </p>
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
                    <td>Confirm password dont equal password</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
