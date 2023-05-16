
import HomePage from "./components/Homepage";
import InteractivityPage from "./components/interactivity";
import DoctoralPage from "./components/doctoral";
import WipPage from "./components/wip";
import RapidPage from "./components/rapid";
import {Route, Routes} from "react-router-dom";
import Menu from "./components/menu";
import Footer from "./components/footer";
import FullPapers from "./components/fullpapers";
import NotFound from "./components/NotFound";
import Competition from "./components/competition";
import AdminPage from "./components/AdminPage";
import {useState} from "react";
import PapersPage from "./components/Papers";
import Papers from "./components/Papers";
import PapersMenu from "./components/PapersMenu";





function App() {
  const [authenticated, setAuthenticated] = useState(false);
  const handleAuthenticated=(isAuthenticated)=>{ setAuthenticated(isAuthenticated); }

  return (

    <div className="App">
      <Menu/>
      <Routes>
        <Route path="/"  element={<HomePage/>}/>
        <Route path="/Papers" element={<PapersMenu />} >
          <Route index element={<PapersPage/>}/>
        <Route path="fullpapers" element={<FullPapers/>}/>
        <Route path="competition"element={<Competition/>}/>
        <Route path="interactivity" element={ <InteractivityPage />}/>
        <Route path="doctoral" element={<DoctoralPage />}/>
        <Route path="wip" element={ <WipPage />}/>
        <Route path="rapid" element={<RapidPage />}/>
        </Route>
        <Route path="/admin" element={<AdminPage  authenticated ={authenticated} handleAuthenticated={setAuthenticated} papers={Papers}/>}/>
        <Route path="*" element={<NotFound/>}/>

      </Routes>
        <Footer/>
    </div>
  );
}

export default App;
