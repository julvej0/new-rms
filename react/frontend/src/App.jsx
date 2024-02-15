import {BrowserRouter, Route, Routes} from "react-router-dom"
import {Layout} from "./components"
import Home from "./pages/public-user/home/Home";
import IpAssets from "./pages/public-user/ip-assests/IpAssets";
import About from "./pages/public-user/about/About";
import Articles from "./pages/public-user/articles/Articles";
import AuthorInfo from "./pages/public-user/author-info/AuthorInfo";

function App() {

  return (
    <>
      <BrowserRouter>
      <Routes>
        <Route path="/" element={<Layout />}>
          <Route index element={<Home />} />
          <Route path="ip-assets" element={<IpAssets />} />
          <Route path="about" element={<About />} />
          <Route path="publications" element={<Articles />} />
          <Route path="author-info" element={<AuthorInfo />} />
        </Route>
      </Routes>
    </BrowserRouter>
    </>
  );
}

export default App;
