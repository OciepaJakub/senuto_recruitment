package main

import (
	"encoding/json"
	"log"
	"net/http"
	"net/mail"
	"regexp"
	"strings"
	"unicode"
)

type FormData struct {
	Email     string `json:"email"`
	Password  string `json:"password"`
	FirstName string `json:"first_name"`
	LastName  string `json:"last_name"`
}

func isValidEmail(email string) bool {
	_, err := mail.ParseAddress(email)
	return err == nil
}

func isPasswordSecure(password string) string {
	var (
		hasUpperCase bool
		hasLowerCase bool
		hasDigit     bool
		hasSpecial   bool
	)

	for _, char := range password {
		if unicode.IsUpper(char) {
			hasUpperCase = true
		} else if unicode.IsLower(char) {
			hasLowerCase = true
		} else if unicode.IsDigit(char) {
			hasDigit = true
		} else {
			hasSpecial = true
		}
	}

	if len(password) < 12 {
		return "Hasło jest za krótkie, powinno posiadać conajmniej 12 znaków."
	} else if !hasUpperCase {
		return "Hasło powinno zawierać conajmniej jedną wielką literę"
	} else if !hasLowerCase {
		return "Hasło powinno zawierać conajmniej jedną małą literę"
	} else if !hasDigit {
		return "Hasło powinno zawierać conajmniej jedną liczbę"
	} else if !hasSpecial {
		return "Hasło powinno zawierać conajmniej jeden znak specjalny"
	}

	return "1"
}

func sanitizeInput(input string) string {
	input = strings.TrimSpace(input)
	re := regexp.MustCompile(`<.*?>`)

	return re.ReplaceAllString(input, "")
}

func formHandler(w http.ResponseWriter, r *http.Request) {
	if r.Method != http.MethodPost {
		http.Error(w, "Method not allowed", http.StatusMethodNotAllowed)
		return
	}

	var data FormData

	if err := json.NewDecoder(r.Body).Decode(&data); err != nil {
		http.Error(w, "Invalid JSON", http.StatusBadRequest)
		return
	}

	email := sanitizeInput(data.Email)
	password := data.Password

	if !isValidEmail(email) {
		http.Error(w, "Invalid email address", http.StatusBadRequest)
		return
	}

	resultOfSecurePassword := isPasswordSecure(password)

	if resultOfSecurePassword != "1" {
		http.Error(w, resultOfSecurePassword, http.StatusBadRequest)
		return
	}

	log.Printf("Received: %+v\n", data)

	// sanitize before save:
	// firstName := sanitizeInput(data.FirstName)
	// lastName := sanitizeInput(data.LastName)

	w.WriteHeader(http.StatusOK)
	w.Write([]byte("Form submitted successfully!"))
}

func main() {
	http.HandleFunc("/submit", formHandler)

	log.Println("Server running on http://localhost:8080")

	if err := http.ListenAndServe(":8080", nil); err != nil {
		log.Fatal(err)
	}
}
