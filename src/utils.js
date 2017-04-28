import React from "react";
import 'whatwg-fetch';
/*
 * Fetch Helpers
 * How to Use Examples:
 * 1. Create New: fetchUpdater("session", data);
 * 2. Update Existing: fetchUpdater("session", data, "1807");
 */

export const fetchUpdater = (route, data, id) => {

    const determinePostURI = (route, id) => {

        if (id == "undefined") {
            return POST_SUBMITTER.root + "wp/v2" + route;
        }
        else {
            return POST_SUBMITTER.root + "wp/v2/" + route + "/" + id;
        }

    };

    let url = determinePostURI(route, id);

    fetch(
        url,
        {
            method: "POST",
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json",
                "X-WP-Nonce": POST_SUBMITTER.nonce
            },
            credentials: "same-origin"
        }).then(function (response) {

        // console.log(response);
        // response.status     //=> number 100–599
        // response.statusText //=> String
        // response.headers    //=> Headers
        // response.url        //=> String

        return response.text()
    }, function (error) {
        // console.log(error);
        // error.message //=> String
    });

};

export const matchingPosts = (posts, id) => {

    const matchingPosts = posts.filter(function (post) {
        // console.log("matching posts singles", post);
        if (post.sessions_festival == id) {
            return post;
        }
    });

    const sessionParents = matchingPosts.filter((post) => {
        // console.log("session parents singles", post);
        if (post.parent == "0") {
            return post;
        }
    });

    const sessionChildren = sessionParents.map((post) => {
        // console.log("session children singles", post);
        let parent = post.id;
        let childPosts = matchingPosts.filter((post) => {
            if (parent == post.parent) {
                return post;
            }
        });

        return {
            id: post.id,
            parent: post.title.rendered,
            posts: childPosts
        }

    });

    // let sessions = sessionChildren.forEach(function (p) {
    //     if (p.parent == "0") {
    //         // console.log("parent", post.id);
    //         let parent = p.id;
    //         festivalMatch.forEach(function (post) {
    //             if (parent == post.parent) {
    //                 console.log("child", post);
    //                 return (
    //                     <Session post={post} key={post.id}/>
    //                 )
    //             }
    //         })
    //     }
    // });

    // const sessions = sessionChildren.map((group) => {
    //     let session = group.posts.map((post) => [
    //         <Session post={post} key={post.id}/>
    //     ]);
    //
    //     return (
    //         <div key={group.id}>
    //             <h3 key={group.id}>{group.parent}</h3>
    //             {session}
    //         </div>
    //     )
    // });
    //
    // return sessions;
};

export const DisplayHTML = content => {
    const createMarkup = (content) => {
        return {__html: content};
    };

    return <div dangerouslySetInnerHTML={createMarkup(content)}/>;

};

export const createSessions = data => {

    let parentPosts = parseInt(data.groups);
    let childPosts = parseInt(data.sessions);
    let childPostsLimit = parseInt(data.tracks);

    // console.log(parentPosts, childPosts, childPostsLimit);

    const createSession = (data, i) => {
        let id = (POST.id + i).toString();
        console.log(id);
        fetch(POST_SUBMITTER.root + "wp/v2/session", {
            method: "POST",
            body: JSON.stringify({
                title: "2",
                content: " ",
                status: "publish",
                sessions_festival: "1781",
                menu_order: i
            }),
            headers: {
                "Content-Type": "application/json",
                "X-WP-Nonce": POST_SUBMITTER.nonce
            },
            credentials: "same-origin"
        }).then(response => {
                console.log(response);
                /*
                 response.status     //=> number 100–599
                 response.statusText //=> String
                 response.headers    //=> Headers
                 response.url        //=> String
                 */
                return response.text()
            },
            error => {
                console.log(error); // error.message //=> String
            });

    };


    for (let i = 0; i < parentPosts; i++) {
        console.log(i);
        createSession(data, i);
    }

};

export const createSessionParent = data => {
    console.log(data);
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
            /*
             response.status     //=> number 100–599
             response.statusText //=> String
             response.headers    //=> Headers
             response.url        //=> String
             */
            return response.text()
        },
        error => {
            console.log(error); // error.message //=> String
        });
};

export const match = (posts, id) => posts.filter(post => {
    // Match sessions to festival
    if (id == post.sessions_festival) {
        return post
    }
});