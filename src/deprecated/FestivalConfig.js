import React from "react";

import * as Utils from "../utils";

class FestivalConfig extends React.Component {

    constructor() {
        super();
        this.state = {
            id: POST.id,
        };
    }

    handleSubmit(e) {
        e.preventDefault();

        // Set some variables based on form name attributes
        let festival = this.festivalForm;
        let groups = festival.sessionGroups.value; // Session Parent Posts
        let sessions = festival.sessions.value; // Session Child Posts
        let tracks = festival.tracks.value; // Session Child Posts Limit

        // Update Festival Post Meta data
        Utils.fetchUpdater("festival", {
            festival_session_groups: groups,
            festival_sessions: sessions,
            festival_tracks: tracks
        }, this.state.id);

        // Create grid
        // @todo: consider using root state instead?
        Utils.createSessions({
            groups: groups,
            sessions: sessions,
            tracks: tracks
        })

    }

    handleChange(e) {
        // Nothing right now
    }

    render() {

        return (

            <form id="festivalConfig"
                  className={this.state.id}
                  onSubmit={e => this.handleSubmit(e)}
                  key={this.state.id}
                  ref={form => {
                      this.festivalForm = form
                  }}>

                {this.props.apiResultsToState("thing")}

                <label htmlFor="tracks">Tracks:</label>
                <input name="tracks" type="number" defaultValue={POST.tracks}/>
                <label htmlFor="sessionGroups">Session Groups:</label>
                <input name="sessionGroups" type="number" defaultValue={POST.groups}/>
                <label htmlFor="sessions">Sessions Per Track:</label>
                <input name="sessions" type="number" defaultValue={POST.sessions}/>
                <button id="sessionCreator" className="button-primary">
                    <span>Update Sessions</span>
                </button>
            </form>
        );

    }


}

export default FestivalConfig;