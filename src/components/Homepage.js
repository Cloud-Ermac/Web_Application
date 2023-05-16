/**
 *  This component is the landing page for the application and is the first page that the user will see when they visit the application.
 *  it is a simple page that  links to the other pages in the application.
 *
 * @author Olayinka Hassan
 */
import React from 'react';
import { Container, Card, CardBody, CardTitle, CardSubtitle } from 'reactstrap';
import homeImage from './img/homeimg.jpg';

//function component that displays the HomePage of the application

function HomePage() {
    return (
        //Container element that holds all the content of the page
        <Container className="landing-page-container" >
            {/*Card element that displays the header of the page*/}
            <Card className="bg-success text-white main-header d-flex align-items-center justify-content-center" style={{ marginBottom: '20px' ,marginTop:'50px', }}>
                <CardBody>
                    <CardTitle> <h1>KF6012 Assessment</h1></CardTitle>
                </CardBody>
            </Card>
            {/* Card element that displays the image of the page*/}
            <Card className="landing-page-image-container d-flex align-items-center" style={{ marginBottom: '40px', backgroundColor: '#eeeeee' }}>
                <CardBody>
                    {/* image element that displays the homeImage imported above*/}
                    <img src={homeImage} alt="Home image banner" style={{ objectFit: 'cover', width: '100%', height: '100%', boxShadow: '0 4px 6px -1px rgba(0, 128, 0, 0.3), 0 2px 4px -1px rgba(0, 128, 0, 0.2)', border: '2px solid green'}} />
                    {/* Card Subtitle element that displays the source of the image*/}
                    <CardSubtitle style={{ width: '100%', display: 'block' }}>Photo by <a href="https://unsplash.com/@anniespratt?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Annie Spratt</a> on <a href="https://unsplash.com/photos/_dAnK9GJvdY?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
                    </CardSubtitle>
                </CardBody>
            </Card>
            <Card className="landing-page-text-container bg-success text-white" style={{ marginBottom: '20px' }}>
                {/* Card element that displays the main content of the page*/}
                <CardBody>
                    <CardTitle> <h2>CHI PLAY '21: The Annual Symposium on Computer-Human Interaction in Play</h2></CardTitle>
                    <CardSubtitle>
                        Welcome to CHI PLAY '21, the premier conference for the presentation of innovative research on the design and use of computer-human interaction in play. Join us for a week of exciting presentations, workshops, and demonstrations from leading researchers in the field.
                    </CardSubtitle>
                    <CardSubtitle>
                        This web application is a prototype for the CHI PLAY '21 conference. It is a single page application that allows users to view different details of papers at the conference. The application is built using React and uses a REST API to communicate with a backend server. The backend server is built using PHP and SQLite DB. The application is hosted on an Apache server.
                    </CardSubtitle>
                    <CardSubtitle>
                        The application is built by <b>Olayinka Hassan </b>as part of the KF6012 Web Application Assessment.
                    </CardSubtitle>
                </CardBody>
            </Card>
        </Container>
    );
}

export default HomePage;