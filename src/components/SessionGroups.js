import React from "react";

import Sessions from "./Sessions";

import * as Utils from "../utils";

class SessionGroups extends React.Component {

    constructor() {
        super();
        this.state = {
        };
    }


    createParent(e, post) {
        e.preventDefault();

        // console.log(post.title.rendered)
        //
        // // increase menu order
        // let basePostOrderMenu = Number(post.menu_order);
        // let newPostOrderMenu = basePostOrderMenu + 1;


        let data = {
            title: " ",
            content: " ",
            status: "publish",
            sessions_festival: POST.id,
            //menu_order: newPostOrderMenu
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
                this.props.apiResultsToState("Updating State");

                return response.text()
            },
            error => {
                console.log(error); // error.message //=> String
            });
    }


    render() {

        const findParents = posts => posts.filter(post => {
            if (post.parent == "0") {
                return post;
            }
        });

        const sessionParentPosts = findParents(this.props.posts).map(parentPost => {
            return (
                <div key={parentPost.id} className="session-container">
                    <header className="session-parent">
                        <h3>{parentPost.title.rendered}</h3>
                        <p>{parentPost.menu_order}</p>
                    </header>
                    <Sessions parent={parentPost.id} posts={this.props.posts}  apiResultsToState={this.props.apiResultsToState}/>

                </div>
            )
        });

        return (
            <div className="session-grid">
                {sessionParentPosts}
                <form
                    onSubmit={e => this.createParent(e)}
                    ref={form => this.sessionForm = form}
                >
                    <button className="session-button-add">
                        <span className="dashicons dashicons-plus-alt"></span>
                        <span className="session-add-button-text">Add Session Group</span>
                    </button>
                </form>
            </div>
        )
    }
}

export default SessionGroups;