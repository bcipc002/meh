#!/bin/bash
 
NEBULOUS_URL=${NEBULOUS_URL:-https://api-dev.traderonline.com}
NEBULOUS_VERSION=${NEBULOUS_VERSION:-0.16}
NEBULOUS_CLIENT_ID=${NEBULOUS_CLIENT_ID:-hackathon-6-meh}
NEBULOUS_CLIENT_SECRET=${NEBULOUS_CLIENT_SECRET:-'m}uCO*3h<D.gn7RPSH:V00``Z+,Og)7/'}
 
_options=''
_url=''
for ((i=1;i<=$#;i++))
do
    if [ "${i}" -lt "${#}" ]
    then
        _options="${_options} ${!i}"
    else
        _url="${NEBULOUS_URL}/v${NEBULOUS_VERSION}/${!i}"
    fi
done
 
if [ -z "${_url}" ]
then
    echo "You must provide the route to access!" 1>&2
    exit 1
fi
 
if [ -z "${NEBULOUS_TOKEN}" ]
then
    if [ -z "${NEBULOUS_USER_NAME}" ]
    then
        TOKEN_RESPONSE=$(curl -s -S -X POST --data-urlencode client_id="${NEBULOUS_CLIENT_ID}" --data-urlencode client_secret="${NEBULOUS_CLIENT_SECRET}" --data-urlencode grant_type=client_credentials ${NEBULOUS_URL}/v${NEBULOUS_VERSION}/token) || exit 1
    else
        TOKEN_RESPONSE=$(curl -s -S -X POST --data-urlencode client_id="${NEBULOUS_CLIENT_ID}" --data-urlencode client_secret="${NEBULOUS_CLIENT_SECRET}" --data-urlencode username="${NEBULOUS_USER_NAME}" --data-urlencode password="${NEBULOUS_USER_PASSWORD}" --data-urlencode grant_type=password ${NEBULOUS_URL}/v${NEBULOUS_VERSION}/token) || exit 1
    fi
 
    NEBULOUS_TOKEN=$(echo "${TOKEN_RESPONSE}" | php -r '
        $input = file_get_contents("php://stdin");
        $token = json_decode($input, true);
        if ($token !== null && array_key_exists("access_token", $token)) {
            echo $token["access_token"];
        } else {
            fwrite(STDERR, "Failed to get access token.\n");
            fwrite(STDERR, var_export($token, true));
            exit(1);
        }') || exit 1
fi
 
curl -H "Authorization: Bearer ${NEBULOUS_TOKEN}" ${_options} "${_url}"
