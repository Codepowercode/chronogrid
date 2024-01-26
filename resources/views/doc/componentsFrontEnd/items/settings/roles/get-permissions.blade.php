<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="get-permissions-get-started">
            <h1>Get Permission for role</h1>
            <p>
                Get Permission API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="get-permissions-get-characters">
            <h2><span class="request-method">grt</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/settings/role/get/permissions</code>
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





        <div class="overflow-hidden content-section" id="get-permissions-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
{
    "status": true,
    "permission": [
        {
            "id": 50,
            "name": "company",
            "guard_name": "web",
            "created_at": "2022-07-06T08:50:38.000000Z",
            "updated_at": "2022-07-06T08:50:38.000000Z"
        },
        {
            "id": 51,
            "name": "company_member",
            "guard_name": "web",
            "created_at": "2022-07-06T08:50:38.000000Z",
            "updated_at": "2022-07-06T08:50:38.000000Z"
        },
        ...
    ]
}
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="get-permissions-errors">
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
