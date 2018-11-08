/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// (optional) add server code here
initializeSession();

// Handling all of our errors here by alerting them
function handleError(error) {
    if (error) {
        alert(error.message);
    }
}

function initializeSession() {
    var session = OT.initSession(openTokConfig.apiKey, openTokConfig.sessionId);

    session.on({
        connectionCreated: event => {
            console.log('con created event', event);

            // unhide the subscriber box if somebody joins
            if (event.target.connections.length() > 1) {
                $('.subscriber-col').show();
            }
        }
    });

    // Subscribe to a newly created stream
    session.on('streamCreated', function (event) {
        session.subscribe(event.stream, 'subscriber', {
            insertMode: 'append',
            width: '100%',
            height: '50vh'
        }, handleError);
    });

    session.on('connectionDestroyed', function (event) {
        location.reload(true);
    });

    // Create a publisher
    var publisher = OT.initPublisher('publisher', {
        insertMode: 'append',
        width: '100%',
        height: '50vh'
    }, handleError);

    // Connect to the session
    session.connect(openTokConfig.token, function (error) {
        // If the connection is successful, publish to the session
        if (error) {
            handleError(error);
        } else {
            session.publish(publisher, handleError);
        }
    });
}