
import { getAnsweredQuestions, getUnansweredQuestions, createQuestion } from "@/actions/forum/Question";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { SyntheticEvent, useState } from "react"; // Import useState for client-side form handling
import NewQuestionForm from "./components/NewQuestionForm";
import UnansweredQuestionCard from "./components/unAnsweredQuestions";

const Forum = async () => {
  // Fetch unanswered and answered questions using server actions
  const unansweredResp = await getUnansweredQuestions();
  const answeredResp = await getAnsweredQuestions();

  return (
    <div className="container mx-auto p-6 space-y-8">
      {/* Page Title */}
      <h1 className="text-3xl font-bold text-center text-gray-800">Forum</h1>

      {/* Ask a New Question Section */}
      <section className="space-y-4">
        <h2 className="text-2xl font-semibold text-gray-700">Ask a Question</h2>
        <NewQuestionForm />
      </section>

      {/* Unanswered Questions Section */}
      <section className="space-y-6">
        <h2 className="text-2xl font-semibold text-gray-700">Unanswered Questions</h2>
        
        {unansweredResp.success ? (
          <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
             {unansweredResp.data?.map((question) => (
              <UnansweredQuestionCard
                key={question.id}
                question={question}
              />
            ))}
          </div>
        ) : (
          <p className="text-gray-600">{unansweredResp.error || "No unanswered questions available."}</p>
        )}
      </section>

      {/* Answered Questions Section */}
      <section className="space-y-6">
        <h2 className="text-2xl font-semibold text-gray-700">Answered Questions</h2>

        {answeredResp.success ? (
          <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            {answeredResp.data?.map((question) => (
              <Card key={question.id} className="shadow-lg">
                <CardHeader>
                  <CardTitle>{question.content}</CardTitle>
                </CardHeader>
                <CardContent>
                  <div className="space-y-2">
                    <p className="text-sm font-medium text-gray-700">Answers:</p>
                    {question.answers?.map((answer) => (
                      <div key={answer.id} className="p-3 bg-gray-100 rounded-md">
                        <p className="text-gray-800">{answer.content}</p>
                      </div>
                    ))}
                  </div>
                </CardContent>
              </Card>
            ))}
          </div>
        ) : (
          <p className="text-gray-600">{answeredResp.error || "No answered questions available."}</p>
        )}
      </section>
    </div>
  );
};

export default Forum