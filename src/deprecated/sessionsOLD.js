(function () {

    var createElement = function (element, text, anchor) {
        var btn = document.createElement(element);
        var t = document.createTextNode(text);
        btn.appendChild(t);
        anchor.appendChild(btn);
    };


    var groups = document.querySelectorAll(".cmb-repeatable-grouping");

    var createTracksWrapper = function (elements) {
        elements.forEach(function (element, index, array) {
            var newElement = document.createElement("SECTION");
            newElement.setAttribute("id", "sessionContainer");
            element.appendChild(newElement);
        });

        return elements;
    };


    var createTracksContainers = function (elements) {
        elements.forEach(function (element, index, array) {
            var tracks = element.querySelector("[name='session_groups[" + index + "][tracks]']").value;
            var sessions = element.querySelector("[name='session_groups[" + index + "][festival_number]']").value;
            var container = element.querySelector("#sessionContainer");
            // console.log(tracks, sessions, container);
            // Create SessionGroups
            for (var i = 0, max = tracks; i < max; i++) {
                var newElement = document.createElement("DIV");
                newElement.setAttribute("class", "trackContainers");
                container.appendChild(newElement);
            }
        });

        return elements;
    };

    var createSessionsPerTrack = function (elements) {
        elements.forEach(function (element, index, array) {
            var tracks = element.querySelector("[name='session_groups[" + index + "][tracks]']").value;
            var sessions = element.querySelector("[name='session_groups[" + index + "][festival_number]']").value;
            var containers = element.querySelectorAll(".trackContainers");
            containers.forEach(function (track) {
                // Create SessionGroups
                for (var i = 0, max = sessions; i < max; i++) {
                    var newElement = document.createElement("DIV");
                    newElement.setAttribute("class", "session");
                    track.appendChild(newElement);
                    var elementInner = document.createElement("DIV");
                    elementInner.setAttribute("class", "session-inner");
                    newElement.appendChild(elementInner);
                    createElement("H4","Session", elementInner);
                    createElement("INPUT","", elementInner);
                    createElement("INPUT","", elementInner);
                }
            });
        });
        return elements;
    };

    var createSessionHTML = function (elements) {
        elements.forEach(function (element, index, array) {


        });
    };


    var runSessions = function (groups) {
        createSessionHTML(
            createSessionsPerTrack(
                createTracksContainers(
                    createTracksWrapper(groups)
                )
            )
        )

    };

    var watchChanges = function () {

    };

    // Check if elements exist
    if (groups) {
        runSessions(groups);
    }

})();