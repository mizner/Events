import React from "react";

import * as utils from "../utils";

class Session extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            post: props.post,
            title: props.post.title.rendered,
            content: props.post.content.rendered,
            id: props.post.id,
        };
        this.handleInputChange = this.handleInputChange.bind(this);
        // console.log(props)
    }

    handleInputChange(event) {

        const target = event.target;
        const value = target.value;
        const name = target.name;

        // console.log({
        //     [name]: value
        // });

        let data = {
            [name]: value,
            sessions_festival: POST.id,
            status: "publish"
        };

        utils.fetchUpdater("session", data, this.state.id);


    }


    render() {

        // function createMarkup(content) {return {__html: content};}

        // console.log(this.state.theID);

        return (
            <form className={this.state.id} key={this.state.id}>
                <p className="titleContainer">
                    <label htmlFor="title"><strong>Title: </strong></label>
                    <br/>
                    <input
                        type="text"
                        name="title"
                        placeholder={this.state.title}
                        onChange={this.handleInputChange}
                    />
                </p>
                <p className="contentContainer">
                    <label htmlFor="content"><strong>Content: </strong></label>
                    <br/>
                    <textarea type="text" name="content" placeholder={this.state.content} onChange={this.handleInputChange}>
                    </textarea>
                </p>
            </form>
        )
    }
}

export default Session;