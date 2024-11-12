import React, { useEffect } from 'react';
import { Container, Button } from 'react-bootstrap';
import { useParams, useNavigate } from 'react-router-dom';
import axios from 'axios';

const DeleteProduct = () => {
  const { id } = useParams();
  const navigate = useNavigate();

  const handleDelete = async () => {
    try {
      await axios.delete(`/api/products/${id}`);
      alert('Product deleted successfully!');
      navigate('/view-products');
    } catch (error) {
      console.error('Error deleting product:', error);
      alert('Failed to delete product.');
    }
  };

  const handleCancel = () => {
    navigate('/view-products');
  };

  return (
    <Container>
      <h2>Delete Products</h2>
      <p>Are you sure you want to delete the product with ID: {id}?</p>
      <Button variant="danger" onClick={handleDelete}>Yes, Delete.</Button>
      {' '}
      <Button variant="secondary" onClick={handleCancel}>Cancel</Button>
    </Container>
  );
};

export default DeleteProduct;