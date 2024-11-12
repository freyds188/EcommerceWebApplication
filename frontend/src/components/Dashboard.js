import { useNavigate } from 'react-router-dom';
import { Container, Navbar, Nav, Button, Row, Col } from 'react-bootstrap'; 
import './style.css'; 

function Dashboard() {
  const navigate = useNavigate();

  return (
    <Container fluid>
      <Navbar bg="light" expand="lg" className="mb-4"> 
        <Container>
          <Navbar.Brand href="#home">Product Dashboard</Navbar.Brand>
          <Navbar.Toggle aria-controls="basic-navbar-nav" />
          <Navbar.Collapse id="basic-navbar-nav">
            <Nav className="me-auto">
              <Nav.Link onClick={() => navigate('/add-product')}>Add a Product</Nav.Link>
              <Nav.Link onClick={() => navigate('/view-products')}>View Products</Nav.Link>
            </Nav>
          </Navbar.Collapse>
        </Container>
      </Navbar>
    </Container>
  );
}

export default Dashboard;
