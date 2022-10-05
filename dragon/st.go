package main

import (
	"context"
	"fmt"

	owm "github.com/briandowns/openweathermap"
	"github.com/nikoksr/notify"
	telegram "github.com/nikoksr/notify/service/telegram"
	log "github.com/sirupsen/logrus"
)

func main() {
	// fmt.Println("Start!")
	// fmt.Println("Start! 12345")
	// fmt.Println("12345")
	log.Info("Just an INFO log, no worries")
	log.Warn("A WARN log might make us a bit nervous...")
	log.Error("Now something is really wrong!")

	// Create a telegram service. Ignoring error for demo simplicity.
	telegramService, _ := telegram.New("5742996202:AAH5pDKIdVQ5A_GAxjdOonrfpvcIy3V2eF4")

	// Passing a telegram chat id as receiver for our messages.
	// Basically where should our message be sent?
	telegramService.AddReceivers(-1001559051963)

	// Tell our notifier to use the telegram service. You can repeat the above process
	// for as many services as you like and just tell the notifier to use them.
	// Inspired by http middlewares used in higher level libraries.
	notify.UseServices(telegramService)

	// Send a test message.
	_ = notify.Send(
		context.Background(),
		"Subject/Title",
		"The actual message - Hello, you awesome gophers! :)",
	)

	var apiKey = "b45f5df45d1ccc616bf3d81a91433ee0"

	w, err := owm.NewCurrent("F", "EN", apiKey)
	if err != nil {
		log.Fatalln(err)
	}

	w.CurrentByZip(19125, "US")
	fmt.Println(w)
}
