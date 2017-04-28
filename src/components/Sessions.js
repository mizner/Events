import React from "react";
import 'whatwg-fetch';
import * as Utils from "../utils";
import Session from "./Session";
class Sessions extends React.Component {

    createSession(e) {
        e.preventDefault();

        let data = {
            title: " ",
            content: " ",
            status: "publish",
            parent: this.props.parent,
            sessions_festival: POST.id,
            menu_order: "1"
        };

        fetch(POST_SUBMITTER.root + "wp/v2/session", {
            method: "POST",
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json",
                "X-WP-Nonce": POST_SUBMITTER.nonce
            },
            credentials: "same-origin"
        }).then(response => {
                console.log(response);

                // On Success, update state
                this.props.apiResultsToState();
                return response.text()
            },
            error => {
                console.log(error); // error.message //=> String
            });

    }

    sessionForm() {

    }

    render() {

        const findChildren = (parent, posts) => posts.filter(post => {
            if (post.parent == parent) {
                return post;
            }
        });

        const children = findChildren(this.props.parent, this.props.posts).map(child => {
            return (
                <div key={child.id} className="session-child">
                    <Session post={child}/>
                </div>
            )
        });

        const addSessionForm = (posts) => {
            // remove button if 3 posts exist
            if (posts.length < 3) {
                return (
                    <form
                        onSubmit={e => this.createSession(e)}
                        ref={form => this.sessionForm = form}
                    >
                        <button className="session-group-button">
                            <i className="dashicons dashicons-plus-alt"></i>
                            <p className="session-group-button-text">Add Session</p>
                        </button>
                    </form>
                )
            }
        };

        return (

            <div className="session-group">
                {children}
                {addSessionForm(children)}
            </div>

        )
    };
}


export default Sessions;