import React, { useState, useEffect } from "react";
import axios from "axios";
import "./flashcard.css";

function Flashcard() {
    const [word, setWord] = useState(null);
    const [showEnglish, setShowEnglish] = useState(false);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [favorites, setFavorites] = useState([]);

    // Load first word + favorites
    useEffect(() => {
        fetchRandomWord();
        fetchFavorites();
    }, []);

    const fetchRandomWord = async () => {
        setLoading(true);
        try {
            const response = await axios.get("/api/words/random/fetch");
            setWord(response.data);
            setShowEnglish(false);
            setError(null);
        } catch (err) {
            console.error("Failed to load random word", err);
            setError("Failed to load word");
        } finally {
            setLoading(false);
        }
    };

    const fetchFavorites = async () => {
        try {
            const response = await axios.get("/api/favorites");
            setFavorites(response.data);
        } catch (err) {
            console.error("Failed to load favorites", err);
        }
    };

    const toggleFavorite = async () => {
        if (!word) return;
        const isFav = favorites.some((fav) => fav.word_id === word.id);

        try {
            if (isFav) {
                await axios.delete(`/api/favorites/${word.id}`);
                setFavorites((prev) =>
                    prev.filter((fav) => fav.word_id !== word.id)
                );
            } else {
                const response = await axios.post("/api/favorites", {
                    word_id: word.id,
                });
                setFavorites((prev) => [...prev, response.data]);
            }
        } catch (err) {
            console.error("Failed to toggle favorite:", err);
        }
    };

    if (loading) return <p>Loading word...</p>;
    if (error) return <p>{error}</p>;
    if (!word) return <p>No word found</p>;

    const isFavorite = favorites.some((fav) => fav.word_id === word.id);

    return (
        <div className="flashcard-container">
            <div
                className="flashcard"
                onClick={() => setShowEnglish(!showEnglish)}
            >
                <h2>{showEnglish ? word.english : word.finnish}</h2>
                {word.example_sentence && (
                    <p>
                        <em>{word.example_sentence}</em>
                    </p>
                )}

                <span
                    className="favorite-indicator"
                    onClick={(e) => {
                        e.stopPropagation();
                        toggleFavorite();
                    }}
                    style={{
                        color: isFavorite ? "red" : "grey",
                        marginLeft: "10px",
                        cursor: "pointer",
                    }}
                    title={
                        isFavorite
                            ? "Remove from favorites"
                            : "Add to favorites"
                    }
                >
                    {isFavorite ? "★" : "☆"}
                </span>
            </div>

            <div className="flashcard-buttons">
                <button onClick={fetchRandomWord}>Next Word</button>
            </div>
        </div>
    );
}

export default Flashcard;
