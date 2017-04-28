import React from "react";

import * as Utils from "../utils";


class Session extends React.Component {

    componentDidMount() {
        this.setState({
            saved: true,
            id: this.props.post.id,
            title: this.props.post.title.rendered,
            content: this.props.post.content.rendered
        });
    }

    sessionUpdater(e) {
        e.preventDefault();

        // Get form Data
        let session = this.sessionForm;
        let title = session.title.value;
        let content = session.content.value;
        let id = this.state.id;

        // Set data to be sent via Fetch
        let data = {
            status: "publish",
            title: title,
            content: content,
        };

        // Update the child post (Session)
        Utils.fetchUpdater("session", data, id);

        // Update state to true
        // @todo: this should probably be part of a callback that does a better job of checking fetch status
        this.setState({
            saved: true,
        });

    }

    handleChange(e) {
        let session = this.sessionForm;

        this.setState({
            saved: false,
        });

    }

    savedStateClass() {
        // make sure state exists, then return string to be used for class
        return (this.state) ? this.state.saved : "";
    }

    render() {

        // let's cut down on some typing redundancy
        const post = this.props.post;
        const saved = this.savedStateClass();

        // How to display in regular mark as HTML (not working in input/textarea
        // let content = Utils.DisplayHTML(post.content.rendered);

        return (
            <div key={post.id} className={"session-child-inner saved-" + saved}>

                <form onSubmit={e => this.sessionUpdater(e)} key={post.id}
                      onChange={e => this.handleChange(e)} ref={form => {
                    this.sessionForm = form
                }}>
                    <label htmlFor="title">Name</label>
                    <input name="title" className="" type="text" defaultValue={post.title.rendered}/>
                    <label htmlFor="content">Description</label>
                    <textarea name="content" id="" cols="30" rows="10" defaultValue={post.content.rendered}>
                    </textarea>
                    <button type="submit" className="button button-primary button-large">
                        <span>Update</span>
                    </button>
                </form>

            </div>
        )
    }
}

export default Session;