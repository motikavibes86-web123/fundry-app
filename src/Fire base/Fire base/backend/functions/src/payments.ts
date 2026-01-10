import * as functions from "firebase-functions";
import * as admin from "firebase-admin";

admin.initializeApp();

export const releasePayment = functions.https.onCall(
  async (data, context) => {
    if (!context.auth) {
      throw new functions.https.HttpsError("unauthenticated", "Login required");
    }

    const { bookingId } = data;

    const bookingRef = admin.firestore().collection("bookings").doc(bookingId);
    const bookingSnap = await bookingRef.get();

    if (!bookingSnap.exists) {
      throw new functions.https.HttpsError("not-found", "Booking not found");
    }

    const booking = bookingSnap.data();

    if (booking?.status !== "completed") {
      throw new functions.https.HttpsError("failed-precondition", "Job not completed");
    }

    const total = booking.amount;
    const commission = total * 0.10;
    const fundiAmount = total - commission;

    await admin.firestore().collection("wallets").doc(booking.fundiId).update({
      balance: admin.firestore.FieldValue.increment(fundiAmount),
    });

    await bookingRef.update({
      paidOut: true,
    });

    return { success: true };
  }
);
