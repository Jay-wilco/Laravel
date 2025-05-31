import { useState, useEffect } from "react";
import axios from "axios";
import NameColorForm from "./NameColorForm/NameColorForm";
import Flashcard from "./Flashcard/Flashcard";

import "./App.css";

function App() {
    const [showFlashcards, setShowFlashcards] = useState(false);
    const [words, setWords] = useState([]);

    useEffect(() => {
        if (showFlashcards) {
            fetchWords();
        }
    }, [showFlashcards]);

    const fetchWords = async () => {
        try {
            const response = await axios.get("https://finnfast.fi/api/words");
            setWords(response.data);
        } catch (err) {
            console.error("Failed to load words:", err);
        }
    };

    return (
        <div className="app-container">
            <button onClick={() => setShowFlashcards(!showFlashcards)}>
                {showFlashcards
                    ? "Switch to Name-Color Form"
                    : "Switch to Flashcards"}
            </button>

            {showFlashcards ? <Flashcard words={words} /> : <NameColorForm />}
        </div>
    );
}

export default App;
