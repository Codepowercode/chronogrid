<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="reset-pass-mail-get-started">
            <h1>Reset password email</h1>
            <p>
                Reset password email API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="reset-pass-mail-get-characters">
            <h2><span class="request-method">post</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/reset/password/code/mail</code>
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
                    <td>email</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter email</td>
                </tr>
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="reset-pass-mail-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
        "status": true,
        "message": "Successfully send email code for reset",
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="reset-pass-mail-errors">
            <h2>Errors</h2>
            <p>
                Not found such a user
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
                    <td>Don't not exist this email</td>
                </tr>

                </tbody>
            </table>
            <p>
                Account blocked
            </p>
            <table>
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>status</td>
                    <td>401</td>
                    <td>boolean</td>
                    <td>false</td>
                </tr>
                <tr>
                    <td>message</td>
                    <td>401</td>
                    <td>string</td>
                    <td>Account blocked, please waiting access with administrator</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
