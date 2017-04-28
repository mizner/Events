import React from "react";
import {render} from 'react-dom';
import 'whatwg-fetch';
import * as Utils from "./utils.js";

import FestivalConfig from "./deprecated/FestivalConfig";

import SessionGroups from "./components/SessionGroups";

class Root extends React.Component {

    constructor() {
        super();
        this.state = {
            posts: [],
            festival: POST.id, // passed from localized script (via WordPress)
            // !!!!!!!!!! Possibly don't need anything below this line
            // groups: POST.groups,
            // sessions: POST.sessions,
            // tracks: POST.tracks
        };
        this.apiResultsToState = this.apiResultsToState.bind(this);
    }

    apiResultsToState() {

        fetch(POST_SUBMITTER.root + 'wp/v2/session')

            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error("Server response wasn't OK");
                }
            })

            .then((responseData) => {

                // Make sure we filter out the "session" posts which don't match the "festival" post id
                let posts = Utils.match(responseData, POST.id);

                // Order posts object by value "menu_order"
                // Credit to: http://stackoverflow.com/questions/1129216/sort-array-of-objects-by-string-property-value-in-javascript#answer-1129270
                posts.sort((a, b) => {
                    return (a.menu_order > b.menu_order) ? 1 : ((b.menu_order > a.menu_order) ? -1 : 0);
                });

                this.setState({
                    posts: posts
                });
            })
    }

    componentWillMount() {
        this.apiResultsToState()
    }


    render() {

        return (
            <div id="sessionsContainer">
                <SessionGroups posts={this.state.posts} apiResultsToState={this.apiResultsToState}/>
            </div>
        )
    }
}

render(<Root/>, document.getElementById("sessions"));
