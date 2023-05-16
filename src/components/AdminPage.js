import React, {useState, useEffect, ChangeEventHandler} from "react";
import {Buffer} from "buffer";
import {fetchPapers} from "./subcomponents/paperFunctions";
import ResultsperPage from "./subcomponents/resultsperPage";
import {Card} from "react-bootstrap";
import Form from "react-bootstrap/Form";


function AdminPage(props) {
    const [username, setUsername] = useState("");
    const [password, setPassword] = useState("");
    const [papers, setPapers] = useState([]);
    const [loading, setLoading] = useState(true);
    const [resultsPerPage, setResultsPerPage] = useState(10);

//fetch papers from database
    useEffect(() => {
        fetchPapers("", resultsPerPage)
            .then((data) => {
                setPapers(data);
                setLoading(false)
            })
            .catch((e) => {
                console.log(e.message)
                alert("Something went wrong Please try again!")
            })
    }, [resultsPerPage]);


    useEffect(
        () => {
            if (localStorage.getItem('token')) {
                props.handleAuthenticated(true)
            }
        }
        ,)
//handle login
    const handleUsernameChange = (e) => {
        setUsername(e.target.value);
    }
    const handlePassword= (e) => {
        setPassword(e.target.value.trim());
    }
    const handleSignOut = () => {
        props.handleAuthenticated(false)
        setPassword("");
        setUsername("");
        localStorage.removeItem('token')
    }

//handle search
    const handleSubmit = (e) => {
        const encodedString = Buffer.from(username + ":" + password).toString("base64");

        fetch("http://unn-w19014555.newnumyspace.co.uk/WebApp/coursework/api/auth",
        {
            method: 'POST',
            headers: new Headers({"Authorization":"Basic " + encodedString})
        } )
            .then((response) => {
                return response.json();
            })
            .then((json) => {
                    if (json.message==="success") {
                        props.handleAuthenticated(true);
                        localStorage.setItem('token', json.jwt);
                    }
                }
            ).catch((e) => {
                console.log(e.message);
            }
        )

    }
    //handle award change
    const handleSelect:ChangeEventHandler <HTMLSelectElement> =(e,paper_id) => {
     const formData = new FormData();
     formData.append('award', e.target.value);
     formData.append('paper_id', paper_id);
     const token = localStorage.getItem('token');
        fetch("http://unn-w19014555.newnumyspace.co.uk/WebApp/coursework/api/update",
            {
                method: 'POST',
                headers: new Headers ({"Authorization":"Bearer " + token}),
                body: formData
            })
            .then((response) => response.text())
            .then((json) => {
                console.log(json);
                alert("Award updated successfully !");
                // Make another API call to fetch the updated list of papers
                return fetchPapers("", resultsPerPage);
            })
            .then((data) => {
                // Update the papers state with the updated list of papers
                setPapers(data);
            })
            .catch((e) => {
                console.log(e.message);
            });
    }

   const allPapers = papers.map((value,key)=> <Card key={value.paper_id} border ="success" text ="success"> <Card.Header as= "h5">
       {value.title}</Card.Header>
       <Form.Text id="awardhelp" muted>
           Select award to update the award status
       </Form.Text>
       <Form.Select  value={value.award.toLowerCase()} onChange={(e) => handleSelect(e, value.paper_id)}>

         <option value="false">No Award</option>
          <option value="true">Award</option>
      </Form.Select>

       </Card>);

    return (
    <div>

        {props.authenticated&&<div>
            <h1>Admin Page</h1>

            <input type = "button" value="Sign out" onClick={handleSignOut}/>
            <ResultsperPage
                resultsPerPage={resultsPerPage}
                setResultsPerPage={setResultsPerPage}
            />
            {loading && <p>Loading...</p>}
            {!loading && allPapers}
        </div>}

        {!props.authenticated&&<div>
            <h2>Sign in</h2>
            <form>
                <label>
                    Username:
                    <input type="text" name="username" value={username} onChange={handleUsernameChange}/>
                </label>
                <label>
                    Password:
                    <input type="password" name="password" value={password} onChange={handlePassword}/>
                </label>
                <input type="button" value="Submit"  disabled={username === "" || password === ""} onClick={handleSubmit} />
            </form>
        </div>}

    </div>
  );
}
export default AdminPage;
