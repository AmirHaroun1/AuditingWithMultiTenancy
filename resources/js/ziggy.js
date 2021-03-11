    var Ziggy = {
        namedRoutes: {"debugbar.openhandler":{"uri":"_debugbar\/open","methods":["GET","HEAD"],"domain":null},"debugbar.clockwork":{"uri":"_debugbar\/clockwork\/{id}","methods":["GET","HEAD"],"domain":null},"debugbar.telescope":{"uri":"_debugbar\/telescope\/{id}","methods":["GET","HEAD"],"domain":null},"debugbar.assets.css":{"uri":"_debugbar\/assets\/stylesheets","methods":["GET","HEAD"],"domain":null},"debugbar.assets.js":{"uri":"_debugbar\/assets\/javascript","methods":["GET","HEAD"],"domain":null},"debugbar.cache.delete":{"uri":"_debugbar\/cache\/{key}\/{tags?}","methods":["DELETE"],"domain":null},"login":{"uri":"login","methods":["GET","HEAD"],"domain":null},"logout":{"uri":"logout","methods":["POST"],"domain":null},"register":{"uri":"register","methods":["GET","HEAD"],"domain":null},"password.request":{"uri":"password\/reset","methods":["GET","HEAD"],"domain":null},"password.email":{"uri":"password\/email","methods":["POST"],"domain":null},"password.reset":{"uri":"password\/reset\/{token}","methods":["GET","HEAD"],"domain":null},"password.update":{"uri":"password\/reset","methods":["POST"],"domain":null},"password.confirm":{"uri":"password\/confirm","methods":["GET","HEAD"],"domain":null},"home":{"uri":"\/","methods":["GET","HEAD"],"domain":null},"campaign.index":{"uri":"Campaigns","methods":["GET","HEAD"],"domain":null},"campaign.search":{"uri":"search\/Campaigns\/{name}","methods":["GET","HEAD"],"domain":null},"campaign.create":{"uri":"CreateNewCampaign\/{project?}\/{section?}","methods":["GET","HEAD"],"domain":null},"campaign.store":{"uri":"newCampaign\/{campaign_id}\/remember\/{campaign_name}\/with\/{Donation_words}","methods":["GET","HEAD"],"domain":null},"campaign.show":{"uri":"Campaign\/{campaign_id}\/Remember\/{campaign_name}","methods":["GET","HEAD"],"domain":null},"user.show":{"uri":"MyProfile","methods":["GET","HEAD"],"domain":null},"user.edit":{"uri":"MyProfile\/edit","methods":["GET","HEAD"],"domain":null},"user.update":{"uri":"MyProfile\/update","methods":["PATCH"],"domain":null},"charity.show":{"uri":"Charity\/{name}","methods":["GET","HEAD"],"domain":null},"check.out":{"uri":"checkout\/{DonationAmount}","methods":["GET","HEAD"],"domain":null}},
        baseUrl: 'http://localhost/',
        baseProtocol: 'http',
        baseDomain: 'localhost',
        basePort: false,
        defaultParameters: []
    };

    if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
        for (var name in window.Ziggy.namedRoutes) {
            Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
        }
    }

    export {
        Ziggy
    }
