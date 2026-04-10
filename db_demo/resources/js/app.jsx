import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import SchemaVisualizerPage from './pages/SchemaVisualizerPage';
import '../css/app.css';

const App = () => {
    return (
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<SchemaVisualizerPage />} />
                <Route path="/schema-visualizer" element={<SchemaVisualizerPage />} />
                <Route path="*" element={<SchemaVisualizerPage />} />
            </Routes>
        </BrowserRouter>
    );
};

ReactDOM.createRoot(document.getElementById('app')).render(
    <React.StrictMode>
        <App />
    </React.StrictMode>
);
